<?php
if (!isset($base_url)) {
    $base_url = '/Hostel/';
}

$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle Add Floor action
if (isset($_POST['add_floor'])) {
    $roomType = $_POST['roomType'];
    $totalRooms = (int)$_POST['totalRooms'];
    $bedsPerRoom = (int)$_POST['bedsPerRoom'];

    $maxFloorQuery = mysqli_query($conn, "SELECT MAX(CAST(SUBSTRING(roomNumber, 1, 1) AS UNSIGNED)) as maxFloor FROM rooms");
    $maxFloorData = mysqli_fetch_assoc($maxFloorQuery);
    $newFloor = ($maxFloorData['maxFloor'] ?? 0) + 1;

    for ($i = 1; $i <= $totalRooms; $i++) {
        $roomNumber = $newFloor . str_pad($i, 2, '0', STR_PAD_LEFT);
        $insertQuery = "INSERT INTO rooms (roomNumber, roomType, totalBeds, occupiedBeds) 
                        VALUES ('$roomNumber', '$roomType', $bedsPerRoom, 0)";
        mysqli_query($conn, $insertQuery);
    }
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Handle Add Room action
if (isset($_POST['add_room'])) {
    $roomNumber = $_POST['roomNumber'];
    $roomType = $_POST['roomType'];
    $totalBeds = (int)$_POST['totalBeds'];
    $occupiedBeds = 0;

    $checkQuery = mysqli_query($conn, "SELECT * FROM rooms WHERE roomNumber='$roomNumber'");
    if (mysqli_num_rows($checkQuery) == 0) {
        $insertQuery = "INSERT INTO rooms (roomNumber, roomType, totalBeds, occupiedBeds) 
                        VALUES ('$roomNumber', '$roomType', $totalBeds, $occupiedBeds)";
        mysqli_query($conn, $insertQuery);
    }
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Fetch all rooms grouped by floor
$roomsQuery = mysqli_query($conn, "SELECT * FROM rooms ORDER BY CAST(roomNumber AS UNSIGNED) ASC");
$roomsByFloor = [];
$maxFloor = 0;
while ($room = mysqli_fetch_assoc($roomsQuery)) {
    $floor = intval(substr($room['roomNumber'], 0, 1));
    $roomsByFloor[$floor][] = $room;
    if ($floor > $maxFloor) $maxFloor = $floor;
}

// Stats
$totalRooms = mysqli_num_rows($roomsQuery);
$occupiedBedsQuery = mysqli_query($conn, "SELECT SUM(occupiedBeds) as totalOccupied FROM rooms");
$occupiedData = mysqli_fetch_assoc($occupiedBedsQuery);
$totalOccupied = $occupiedData['totalOccupied'] ?? 0;

$totalBedsQuery = mysqli_query($conn, "SELECT SUM(totalBeds) as totalBeds FROM rooms");
$bedsData = mysqli_fetch_assoc($totalBedsQuery);
$totalBeds = $bedsData['totalBeds'] ?? 0;
$availableBeds = $totalBeds - $totalOccupied;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - ROSELLE Hostel</title>
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/admin-room.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
<style>
    /* Sidebar Container */
.student-sidebar {
    position: fixed;
    top: 110px;               /* adjust for your header */
    right: -400px;            /* hidden by default */
    width: 400px;
    height: calc(100% - 110px); /* full height minus header */
    background: #fff;
    border-left: 2px solid #ccc;
    box-shadow: -5px 0 20px rgba(0,0,0,0.15);
    transition: right 0.35s ease;
    overflow-y: auto;
    padding: 20px;
    z-index: 9999;
    border-radius: 8px 0 0 8px;
}

/* Active State (show sidebar) */
.student-sidebar.active { 
    right: 0; 
}

/* Sidebar Header */
.student-sidebar h3 {
    margin-top: 0;
    font-size: 22px;
    font-weight: 600;
    color: #333;
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
    margin-bottom: 15px;
}

/* Student List */
.student-sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.student-sidebar li {
    margin-bottom: 12px;
    padding: 10px;
    background: #f9f9f9;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.student-sidebar li:hover {
    background: #1abc9c;
    color: #fff;
    transform: translateX(-5px);
}

/* Optional: student details small text */
.student-sidebar li small {
    font-size: 12px;
    color: #666;
}

/* Room Card Adjustments */
.room-card {
    position: relative;
    z-index: 1;
    transition: transform 0.3s, box-shadow 0.3s;
    cursor: pointer;
}

.room-card:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    z-index: 5; /* higher than other content, lower than sidebar */
}

/* Ensure main content leaves space for sidebar */
.main-content {
    margin-left: 250px;  /* your left sidebar width */
    position: relative;
    z-index: 1;
}

/* Scrollbar Styling */
.student-sidebar::-webkit-scrollbar {
    width: 8px;
}

.student-sidebar::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.student-sidebar::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 4px;
}

.student-sidebar::-webkit-scrollbar-thumb:hover {
    background: #999;
}

/* Responsive */
@media (max-width: 1024px) {
    .student-sidebar { width: 300px; }
}

@media (max-width: 768px) {
    .student-sidebar { width: 250px; right: -250px; }
}
</style>

    </style>
</head>
<body>
<?php include('admin-header.php'); ?>
<div class="dashboard-container">
    <?php include('admin-slidebar.php'); ?>
    <main class="main-content">
        <!-- Stats -->
        <div class="stats-container">
            <div class="stat-card total-rooms"><h3>Total Rooms</h3><div class="value"><?= $totalRooms ?></div></div>
            <div class="stat-card total-beds"><h3>Total Beds</h3><div class="value"><?= $totalBeds ?></div></div>
            <div class="stat-card occupied"><h3>Occupied Beds</h3><div class="value"><?= $totalOccupied ?></div></div>
            <div class="stat-card available"><h3>Available Beds</h3><div class="value"><?= $availableBeds ?></div></div>
        </div>

        <div class="floor-section-wrapper">
            <div class="floor-header">
                <div class="floor-buttons-container">
                    <div class="floor-buttons">
                        <?php for ($floor = 1; $floor <= $maxFloor; $floor++): ?>
                            <button class="floor-btn <?= $floor === 1 ? 'active' : '' ?>" onclick="toggleFloor(<?= $floor ?>, this)">Floor <?= $floor ?></button>
                        <?php endfor; ?>
                    </div>
                </div>
                <div class="action-buttons">
                    <button class="add-btn" onclick="openAddFloorModal()"><i class="fas fa-plus"></i> Add Floor</button>
                    <button class="add-btn" onclick="openAddRoomModal()"><i class="fas fa-door-open"></i> Add Room</button>
                </div>
            </div>

            <?php for ($floor = 1; $floor <= $maxFloor; $floor++): ?>
                <div id="floor-<?= $floor ?>" class="room-details" style="<?= $floor === 1 ? 'display: block;' : 'display: none;' ?>">
                    <h2>Floor <?= $floor ?> Rooms</h2>
                    <div class="room-grid">
                        <?php if (!empty($roomsByFloor[$floor])): ?>
                            <?php foreach ($roomsByFloor[$floor] as $room): ?>
                                <?php
                                    $availableBeds = $room['totalBeds'] - $room['occupiedBeds'];
                                    $statusClass = $availableBeds > 0 ? 'available' : 'occupied';
                                    $occupancyPercentage = ($room['totalBeds'] > 0) ? ($room['occupiedBeds'] / $room['totalBeds']) * 100 : 0;
                                ?>
                                <div class="room-card <?= $statusClass ?>" data-room="<?= $room['roomNumber'] ?>">
                                    <span class="room-status"><?= strtoupper($statusClass) ?></span>
                                    <h3>Room <?= htmlspecialchars($room['roomNumber']) ?></h3>
                                    <p>Type: <strong><?= htmlspecialchars($room['roomType']) ?></strong></p>
                                    <p>Total Beds: <strong><?= $room['totalBeds'] ?></strong></p>
                                    <p>Occupied: <strong><?= $room['occupiedBeds'] ?></strong></p>
                                    <p>Available: <strong><?= $availableBeds ?></strong></p>
                                    <div class="progress-bar"><div class="progress-fill" style="width: <?= $occupancyPercentage ?>%"></div></div>
                                    <p><small><?= round($occupancyPercentage) ?>% occupied</small></p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="no-rooms-message"><p>No rooms available on this floor.</p></div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </main>
</div>

<!-- Sidebar -->
<div id="studentSidebar" class="student-sidebar">
    <div id="studentDetails"><h3>Hover over a room to view students</h3></div>
</div>

<!-- Add Room Modal -->
<div id="addRoomModal" class="modal">
    <div class="modal-content">
        <h2>Add New Room</h2>
        <form method="POST" action="">
            <div class="form-group"><label for="roomNumber">Room Number</label><input type="text" id="roomNumber" name="roomNumber" required></div>
            <div class="form-group"><label for="roomType">Room Type</label>
                <select id="roomType" name="roomType" required>
                    <option value="AC">AC</option>
                    <option value="Non-AC">Non-AC</option>
                </select>
            </div>
            <div class="form-group"><label for="totalBeds">Total Beds</label><input type="number" id="totalBeds" name="totalBeds" min="1" max="10" required></div>
            <div class="modal-buttons">
                <button type="button" class="modal-btn cancel" onclick="closeAddRoomModal()">Cancel</button>
                <button type="submit" name="add_room" class="modal-btn submit">Add Room</button>
            </div>
        </form>
    </div>
</div>

<!-- Add Floor Modal -->
<div id="addFloorModal" class="modal">
    <div class="modal-content">
        <h2>Add New Floor</h2>
        <form method="POST" action="">
            <div class="form-group"><label for="floorRoomType">Room Type</label>
                <select id="floorRoomType" name="roomType" required>
                    <option value="AC">AC</option>
                    <option value="Non-AC">Non-AC</option>
                </select>
            </div>
            <div class="form-group"><label for="totalRooms">Total Rooms</label><input type="number" id="totalRooms" name="totalRooms" min="1" required></div>
            <div class="form-group"><label for="bedsPerRoom">Beds per Room</label><input type="number" id="bedsPerRoom" name="bedsPerRoom" min="1" max="10" required></div>
            <div class="modal-buttons">
                <button type="button" class="modal-btn cancel" onclick="closeAddFloorModal()">Cancel</button>
                <button type="submit" name="add_floor" class="modal-btn submit">Add Floor</button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleFloor(floor, element) {
    document.querySelectorAll('.room-details').forEach(el => el.style.display = 'none');
    document.getElementById('floor-' + floor).style.display = 'block';
    document.querySelectorAll('.floor-btn').forEach(btn => btn.classList.remove('active'));
    element.classList.add('active');
}

function openAddRoomModal() { document.getElementById('addRoomModal').style.display = 'flex'; }
function closeAddRoomModal() { document.getElementById('addRoomModal').style.display = 'none'; }

function openAddFloorModal() { document.getElementById('addFloorModal').style.display = 'flex'; }
function closeAddFloorModal() { document.getElementById('addFloorModal').style.display = 'none'; }

window.onclick = function(event) {
    const addRoomModal = document.getElementById('addRoomModal');
    const addFloorModal = document.getElementById('addFloorModal');
    if (event.target === addRoomModal) closeAddRoomModal();
    if (event.target === addFloorModal) closeAddFloorModal();
}

// Hover sidebar logic
document.querySelectorAll('.room-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        const roomNumber = this.getAttribute('data-room');
        document.getElementById('studentSidebar').classList.add('active');
        fetch('get_students.php?roomNumber=' + roomNumber)
            .then(res => res.text())
            .then(data => { document.getElementById('studentDetails').innerHTML = data; });
    });
});
document.getElementById('studentSidebar').addEventListener('mouseleave', function() {
    this.classList.remove('active');
});
</script>
</body>
</html>
