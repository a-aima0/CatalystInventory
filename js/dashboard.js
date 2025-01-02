let sidebar = document.getElementById('sidebar');
let logo = document.querySelector('.dashboardLogo');
let isDragging = false;
let offsetX = 0;
let initialX = 0;

// When mouse is pressed on the sidebar
sidebar.addEventListener('mousedown', (e) => {
    isDragging = true; // Start dragging
    initialX = e.clientX;  // Store the initial X position of the mouse
    offsetX = sidebar.offsetLeft;  // Store the initial left position of the sidebar
    sidebar.classList.add('moving');  // Add moving class for visual feedback
});

// When mouse is moved
document.addEventListener('mousemove', (e) => {
    if (isDragging) {
        let currentX = e.clientX;  // Current X position of the mouse
        let newLeft = offsetX + (currentX - initialX);  // Calculate new left position for sidebar
        sidebar.style.left = newLeft + 'px';  // Update sidebar position
        logo.style.left = newLeft + 20 + 'px';  // Keep the logo aligned with the sidebar
    }
});

// When mouse button is released
document.addEventListener('mouseup', () => {
    isDragging = false;  // Stop dragging
    sidebar.classList.remove('moving');  // Remove the moving class
});
