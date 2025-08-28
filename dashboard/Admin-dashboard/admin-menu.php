<?php
$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    foreach ($data as $index => $meals) {
        $dayIndex = $index + 1; // ID in DB starts from 1
        $breakfast = mysqli_real_escape_string($conn, $meals['breakfast']);
        $lunch = mysqli_real_escape_string($conn, $meals['lunch']);
        $snacks = mysqli_real_escape_string($conn, $meals['snacks']);
        $dinner = mysqli_real_escape_string($conn, $meals['dinner']);

        mysqli_query($conn, "UPDATE food_menu 
            SET breakfast='$breakfast', lunch='$lunch', snacks='$snacks', dinner='$dinner' 
            WHERE id=$dayIndex");
    }

    echo json_encode(["status" => "success"]);
    exit;
}

// ---------- Fetch Menu ----------
$menu = [];
$result = mysqli_query($conn, "SELECT * FROM food_menu ORDER BY id ASC");
while ($row = mysqli_fetch_assoc($result)) {
    $menu[] = [$row['breakfast'], $row['lunch'], $row['snacks'], $row['dinner']];
}

// Days array
$days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];

if (!isset($base_url)) {
    $base_url = '/Hostel/';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - ROSELLE Hostel</title>
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/admin-header.css" />
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/admin-slidebar.css" />
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/admin-menu.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>
<body>
    <?php include('admin-header.php'); ?>

    <div class="dashboard-container">
        <?php include('admin-slidebar.php'); ?>

        <main class="main-content">
            <div class="tabs-container">
                <ul class="tab-buttons">
                    <?php foreach ($days as $index => $day): ?>
                        <li class="tab-btn <?= $index === 0 ? 'active' : '' ?>" onclick="showTab(<?= $index ?>)"><?= $day ?></li>
                    <?php endforeach; ?>
                </ul>

                <div class="tab-content">
                    <?php foreach ($menu as $i => $meals): ?>
                        <div class="tab-panel <?= $i === 0 ? 'show' : '' ?>">
                            <ul>
                                <li><strong>Breakfast:</strong> 
                                    <span class="meal-text"><?= $meals[0] ?></span>
                                    <input type="text" class="meal-input hidden" value="<?= $meals[0] ?>" />
                                </li>
                                <li><strong>Lunch:</strong> 
                                    <span class="meal-text"><?= $meals[1] ?></span>
                                    <input type="text" class="meal-input hidden" value="<?= $meals[1] ?>" />
                                </li>
                                <li><strong>Snacks:</strong> 
                                    <span class="meal-text"><?= $meals[2] ?></span>
                                    <input type="text" class="meal-input hidden" value="<?= $meals[2] ?>" />
                                </li>
                                <li><strong>Dinner:</strong> 
                                    <span class="meal-text"><?= $meals[3] ?></span>
                                    <input type="text" class="meal-input hidden" value="<?= $meals[3] ?>" />
                                </li>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="menu-action-buttons" style="margin-top: 20px;">
                <button id="editMenuBtn">Edit Menu</button>
                <button id="saveMenuBtn" class="hidden">Save Changes</button>
            </div>
        </main>
    </div>

<script>
function showTab(index) {
    const tabs = document.querySelectorAll('.tab-btn');
    const panels = document.querySelectorAll('.tab-panel');
    tabs.forEach((tab, i) => {
        tab.classList.toggle('active', i === index);
        panels[i].classList.toggle('show', i === index);
    });
}

const editBtn = document.getElementById('editMenuBtn');
const saveBtn = document.getElementById('saveMenuBtn');

editBtn.addEventListener('click', () => {
    document.querySelectorAll('.meal-text').forEach(span => span.classList.add('hidden'));
    document.querySelectorAll('.meal-input').forEach(input => input.classList.remove('hidden'));
    editBtn.classList.add('hidden');
    saveBtn.classList.remove('hidden');
});

saveBtn.addEventListener('click', () => {
    const textElems = document.querySelectorAll('.meal-text');
    const inputElems = document.querySelectorAll('.meal-input');
    const updatedMenu = [];
    let tempDay = [];

    inputElems.forEach((input, index) => {
        textElems[index].textContent = input.value;
        tempDay.push(input.value);
        if ((index + 1) % 4 === 0) {
            updatedMenu.push({
                breakfast: tempDay[0],
                lunch: tempDay[1],
                snacks: tempDay[2],
                dinner: tempDay[3]
            });
            tempDay = [];
        }
    });

    textElems.forEach(span => span.classList.remove('hidden'));
    inputElems.forEach(input => input.classList.add('hidden'));
    editBtn.classList.remove('hidden');
    saveBtn.classList.add('hidden');

    fetch(window.location.href, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(updatedMenu)
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Menu updated successfully!');
        } else {
            alert('Error saving menu');
        }
    });
});
</script>
</body>
</html>
