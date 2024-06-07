document.addEventListener("DOMContentLoaded", function() {
    const profileIcon = document.getElementById("profile-icon");
    const popup = document.getElementById("popup");
    const closeBtn = document.querySelector(".close-btn");

    profileIcon.addEventListener("click", function(event) {
        event.preventDefault();
        popup.style.display = "block";
    });

    closeBtn.addEventListener("click", function() {
        popup.style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target === popup) {
            popup.style.display = "none";
        }
    });

    // get the number of count from database
    function fetchBookingCounts() {
        // the numbers is to display number of reservation that day and time
        // it is now constant without database please change to the variable in the database
        const bookingCounts = {
            Monday: { "10:00": 5, "11:00": 3, "12:00": 2, "13:00": 6, "14:00": 4, "15:00": 7, "16:00": 8, "17:00": 3, "18:00": 1, "19:00": 4, "20:00": 5, "21:00": 2 },
            Tuesday: { "10:00": 4, "11:00": 2, "12:00": 3, "13:00": 5, "14:00": 6, "15:00": 1, "16:00": 3, "17:00": 2, "18:00": 4, "19:00": 5, "20:00": 7, "21:00": 3 },
            Wednesday: { "10:00": 5, "11:00": 3, "12:00": 2, "13:00": 6, "14:00": 4, "15:00": 7, "16:00": 8, "17:00": 3, "18:00": 1, "19:00": 4, "20:00": 5, "21:00": 2 },
            Thursday: { "10:00": 4, "11:00": 2, "12:00": 3, "13:00": 5, "14:00": 6, "15:00": 1, "16:00": 3, "17:00": 2, "18:00": 4, "19:00": 5, "20:00": 7, "21:00": 3 },
            Friday: { "10:00": 5, "11:00": 3, "12:00": 2, "13:00": 6, "14:00": 4, "15:00": 7, "16:00": 8, "17:00": 3, "18:00": 1, "19:00": 4, "20:00": 5, "21:00": 2 },
            Saturday: { "10:00": 4, "11:00": 2, "12:00": 3, "13:00": 5, "14:00": 6, "15:00": 1, "16:00": 3, "17:00": 2, "18:00": 4, "19:00": 5, "20:00": 7, "21:00": 3 },
            Sunday: { "10:00": 5, "11:00": 3, "12:00": 2, "13:00": 6, "14:00": 4, "15:00": 7, "16:00": 8, "17:00": 3, "18:00": 1, "19:00": 4, "20:00": 5, "21:00": 2 },
        };

        for (const [day, times] of Object.entries(bookingCounts)) {
            for (const [time, count] of Object.entries(times)) {
                const elementId = `count_${day}_${time.replace(":", "")}`;
                const element = document.getElementById(elementId);
                if (element) {
                    element.textContent = count;
                }
            }
        }
    }

    fetchBookingCounts();
});
