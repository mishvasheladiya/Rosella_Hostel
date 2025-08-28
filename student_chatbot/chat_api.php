<?php
header('Content-Type: application/json');

// Connect to DB
$conn = new mysqli("localhost", "root", "", "hostel");
if ($conn->connect_error) {
    echo json_encode(["reply" => "❌ Database connection failed."]);
    exit;
}

// Get user message
$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['message']) || trim($data['message']) === "") {
    echo json_encode(["reply" => "⚠️ Please ask something."]);
    exit;
}

$userMessage = strtolower(trim($data['message']));

// 🔹 1. Greetings
$greetings = ["hi", "hello", "hey", "good morning", "good afternoon", "good evening", "hy"];
foreach ($greetings as $greet) {
    if (strpos($userMessage, $greet) !== false) {
        echo json_encode([
            "reply" => "👋 Hi there! How are you today? You can ask me about hostel fees, rooms, mess timings, menu, events, and more."
        ]);
        exit;
    }
}

// 🔹 2. FAQs
$faqs = [
    // Fees
    "how do i pay hostel fees" => "💳 You can pay hostel fees via UPI, netbanking, debit/credit card, or cash.",
    "what is the last date for hostel fee payment" => "📅 The last date for hostel fee payment will be announced in the 'Fees' section after login.",
    "can i pay my fees in installments" => "✅ Yes, you can request installment payments. Please contact the hostel office for approval.",
    "where can i see my payment history" => "You can check your payment history in the payment section of the portal.",
    "what happens if i pay fees late" => "⚠️ A late fee penalty will be applied as per hostel rules. Please avoid delays.",

    // Room & complaints
    "how do i apply for a room change" => "🏠 You can request a room change by filling out the complaint form.",
    "can i get a single room" => "🚫 No, only 4, 6, and 8-bed rooms are available.",
    "how do i report a roommate issue" => "📝 Report roommate issues through the complaint form.",
    "my fan/light is not working" => "💡 Please submit the complaint form for maintenance requests.",
    "who should i contact for plumbing issues" => "🚿 Submit the complaint form for plumbing or maintenance issues.",
    "for any issues — what should i do" => "🛠 Fill out the complaint form for any hostel-related problems.",
    "how long does it take to fix a complaint" => "⏳ Complaints are usually resolved within 2 days.",
    "how do i report an electrical, pumbing or any other issue" => "⚡🚰 Please use the complaint form for electrical, plumbing, or other maintenance issues.",
    "how do i report an electrical issue" => "⚡🚰 Please use the complaint form for electrical issues.",
    "how do i report a pumbing issue" => "⚡🚰 Please use the complaint form for plumbing issues.",
    "how do i report any other issue" => "⚡🚰 Please use the complaint form for any maintenance issues.",


    // Hostel rules
    "what are the hostel entry/exit timings" => "⏰ Entry/Exit timings: 6:00 AM – 10:00 PM.",
    "are visitors allowed in hostel rooms" => "🚫 Visitors are not allowed inside hostel rooms.",
    "can i keep electric appliances like kettle or heater" => "❌ No, electric appliances like kettles or heaters are not allowed.",
    "what is the penalty for breaking hostel rules" => "📜 Penalties vary from fines to expulsion depending on the rule broken.",

    // Events & notices
    "where can i see hostel notices" => "📢 Hostel notices are available in the 'Notification' section on your dashboard.",
    "when is the next hostel meeting" => "🗓 The date for the next hostel meeting will be posted on the notice board and dashboard.",
    "when will new room allotments happen" => "📌 New room allotments will be announced at the start of the new semester.",

    // Emergency & safety
    "who should i contact in an emergency" => "📞 Contact the warden immediately or call 9876543210.",
    "what is the warden’s contact number" => "☎️ Warden’s Contact: 9876543210",
    "what is the warden’s email" => "📧 Email: itsrosella@rosella.com",
    "what is the warden’s contact number and email" => "☎️ Warden: 9876543210, 📧 Email: itsrosella@rosella.com",
    "email" => "📧 Warden’s Email: m@rosella.com",
    "where is the first-aid box located" => "🩹 The first-aid box is available at the warden’s office.",
    "how do i reach the nearest hospital" => "🏥 The nearest hospital is City Care Hospital, 2 km from the hostel.",
    "where is the common room" => "🛋 The common room is on the ground floor near the main entrance.",

    //festival
    "what festivals are celebrated in january" => "🎉 January Festivals:\n- New Year (Jan 1)\n- Makar Sankranti (Jan 14)\n- Pongal and Lohri (January)",
    "what festivals are celebrated in february" => "🎉 February Festivals:\n- Valentine's Day (Feb 14)\n- World Cancer Day (Feb 4)",
    "what festivals are celebrated in march" => "🎉 March Festivals:\n- Holi Festival\n- Ram Navami",
    "what festivals are celebrated in april" => "🎉 April Festivals:\n- Ambedkar Jayanti",
    "what festivals are celebrated in may" => "🎉 May Festivals:\n- Gujarat Day (May 1)\n- National Technology Day",
    "what festivals are celebrated in june" => "🎉 June Festivals:\n- International Yoga Day (Jun 21)\n- Eid\n- World Environment Day",
    "what festivals are celebrated in july" => "🎉 July Festivals:\n- Guru Purnima",
    "what festivals are celebrated in august" => "🎉 August Festivals:\n- Independence Day (Aug 15)\n- Raksha Bandhan\n- Janmashtami",
    "what festivals are celebrated in september" => "🎉 September Festivals:\n- Ganesh Chaturthi\n- Onam",
    "what festivals are celebrated in october" => "🎉 October Festivals:\n- Navratri\n- Dussehra\n- Durga Puja\n- Gandhi Jayanti (Oct 2)",
    "what festivals are celebrated in november" => "🎉 November Festival:\n- Diwali",
    "what festivals are celebrated in december" => "🎉 December Festival:\n- Christmas (Dec 25)",

    // For all festivals together
    "list all festivals" => "🎊 Year-round Festivals at Hostel:\n
    - New Year (Jan 1)\n- Makar Sankranti (Jan 14)\n- Pongal and Lohri (January)\n
    - Valentine's Day (Feb 14)\n- World Cancer Day (Feb 4)\n
    - Holi Festival and Ram Navami (March)\n
    - Ambedkar Jayanti (April)\n
    - Gujarat Day (May 1) and National Technology Day (May)\n
    - International Yoga Day (Jun 21), Eid and World Environment Day (June)\n
    - Guru Purnima (July)\n
    - Independence Day (Aug 15), Raksha Bandhan, Janmashtami (August)\n
    - Ganesh Chaturthi, Onam (September)\n
    - Navratri, Dussehra, Durga Puja, Gandhi Jayanti (Oct 2) (October)\n
    - Diwali (November)\n
    - Christmas (Dec 25)",


    // Facilities
    "is there wi-fi in the hostel" => "📶 Yes, free Wi-Fi is available in all hostel areas.",
    "how do i get a hostel id card" => "🪪 Collect your hostel ID card from the warden's office after registration.",
    "can i get laundry services in the hostel" => "👕 Yes, laundry services are available in the hostel.",

    // Mess
    "what are the mess timings" => "⏲ Mess Timings:\n🍳 Breakfast: 7:00 AM – 9:00 AM\n🍛 Lunch: 12:30 PM – 2:30 PM\n🍪 Snacks: 5:00 PM – 6:00 PM\n🍽 Dinner: 7:30 PM – 9:30 PM",
    "can i get food packed for takeaway" => "🥡 Yes, inform the mess staff at least 30 minutes in advance.",
    "how can i request a special meal" => "🍲 All students get the same menu. For special meals, you can use the canteen."
];

// ✅ 3. Check static FAQ
foreach ($faqs as $question => $answer) {
    if (strpos($userMessage, strtolower($question)) !== false) {
        echo json_encode(["reply" => nl2br($answer)]);
        exit;
    }
}

// ✅ 4. Mess menu logic
$days = ["monday","tuesday","wednesday","thursday","friday","saturday","sunday"];
$day = "";

if (strpos($userMessage, "today") !== false) {
    $day = date("l");
} elseif (strpos($userMessage, "tomorrow") !== false) {
    $day = date("l", strtotime("+1 day"));
} else {
    foreach ($days as $d) {
        if (strpos($userMessage, $d) !== false) {
            $day = ucfirst($d);
            break;
        }
    }
}

if ($day !== "") {
    $stmt = $conn->prepare("SELECT * FROM food_menu WHERE day_name = ?");
    $stmt->bind_param("s", $day);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (strpos($userMessage, "breakfast") !== false) {
            $reply = "🍳 $day Breakfast: " . $row['breakfast'];
        } elseif (strpos($userMessage, "lunch") !== false) {
            $reply = "🍛 $day Lunch: " . $row['lunch'];
        } elseif (strpos($userMessage, "snack") !== false) {
            $reply = "🍪 $day Snacks: " . $row['snacks'];
        } elseif (strpos($userMessage, "dinner") !== false) {
            $reply = "🍽 $day Dinner: " . $row['dinner'];
        } else {
            $reply = "📅 $day Menu:\n".
                     "🍳 Breakfast: {$row['breakfast']}\n".
                     "🍛 Lunch: {$row['lunch']}\n".
                     "🍪 Snacks: {$row['snacks']}\n".
                     "🍽 Dinner: {$row['dinner']}";
        }
        echo json_encode(["reply" => nl2br($reply)]);
    } else {
        echo json_encode(["reply" => "❌ No menu found for $day."]);
    }
    $stmt->close();
} else {
    echo json_encode(["reply" => "❓ Sorry, I couldn't find an answer. Try asking differently."]);
}

$conn->close();
?>
