function confirmCancel() {
    document.getElementById('confirm-cancel-popup').style.display = 'block';
}

function confirmEdit() {
    document.getElementById('confirm-edit-popup').style.display = 'block';
}

function cancelBookingConfirmed() {
    // Add logic to cancel the booking
    alert("Booking cancelled");
    document.getElementById('confirm-cancel-popup').style.display = 'none';
}

function editBookingConfirmed() {
    // Add logic to save the edited booking
    alert("Booking details saved");
    document.getElementById('confirm-edit-popup').style.display = 'none';
}
