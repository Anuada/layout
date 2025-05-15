function openTab(tabName) {
    const tabs = document.querySelectorAll('.tab-content');
    tabs.forEach(tab => {
        tab.classList.remove('active');
    });
    
    const tabButtons = document.querySelectorAll('.tab');
    tabButtons.forEach(button => {
        button.classList.remove('active');
    });
    
    document.getElementById(tabName).classList.add('active');
    event.currentTarget.classList.add('active');
}

// Show alerts
document.addEventListener('DOMContentLoaded', function() {
    const successAlert = document.getElementById('successAlert');
    const errorAlert = document.getElementById('errorAlert');
    
    if (successAlert) {
        successAlert.classList.add('show');
        setTimeout(() => {
            successAlert.classList.remove('show');
        }, 5000);
    }
    
    if (errorAlert) {
        errorAlert.classList.add('show');
        setTimeout(() => {
            errorAlert.classList.remove('show');
        }, 5000);
    }
});