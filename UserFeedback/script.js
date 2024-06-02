//JavaScript
document.getElementById('feedbackForm').addEventListener('submit', function(event) 
{
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var feedback = document.getElementById('feedback').value;

    if (!name || !email || !feedback) 
	{
        alert('Please fill in all fields.');
        event.preventDefault();
    }
});