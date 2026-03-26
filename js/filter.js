document.addEventListener('DOMContentLoaded', function() {
    const filterDropdowns = document.querySelectorAll('.filter-dropdown');

    filterDropdowns.forEach(dropdown => {
        const button = dropdown.querySelector('.filter-btn');

        button.addEventListener('click', function(e) {
            e.stopPropagation();

            const isActive = dropdown.classList.contains('active');

            filterDropdowns.forEach(d => d.classList.remove('active'));

            if (!isActive) {
                dropdown.classList.add('active');
            }
        });
    });

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.filter-dropdown')) {
            filterDropdowns.forEach(d => d.classList.remove('active'));
        }
    });

    const dropdownMenus = document.querySelectorAll('.filter-dropdown-menu');
    dropdownMenus.forEach(menu => {
        menu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
});
