document.addEventListener("DOMContentLoaded", function () {
    const bell = document.querySelector(".notification-bell");
    const dropdown = bell.querySelector(".dropdown");

    bell.addEventListener("click", function () {
        dropdown.classList.toggle("show");
    });

    // Optional: mark notifications as read when opened
    bell.addEventListener("click", function () {
        fetch("/Hostel/mark-notifications-read.php")
            .then(res => console.log("Notifications marked as read"));
    });
});
