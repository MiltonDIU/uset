// Function to show/hide sidebar content based on active tab
        function showSidebarContent(tabName) {
            try {
                const sidebarContents = document.querySelectorAll('.tab-sidebar-content');
                if (!sidebarContents.length) {
                    console.warn('No sidebar contents found');
                    return;
                }

                sidebarContents.forEach(content => {
                    content.classList.remove('visible');
                    content.classList.add('hidden');
                });

                const activeContent = document.getElementById(tabName + '-info');
                if (activeContent) {
                    activeContent.classList.remove('hidden');
                    activeContent.classList.add('visible');
                } else {
                    console.warn(`Sidebar content for ${tabName} not found, defaulting to undergraduate`);
                    const defaultContent = document.getElementById('undergraduate-info');
                    if (defaultContent) {
                        defaultContent.classList.remove('hidden');
                        defaultContent.classList.add('visible');
                    }
                }
            } catch (error) {
                console.error('Error switching sidebar content:', error);
            }
        }

        // Function to update today's date dynamically
        function updateTodayDate() {
            try {
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true,
                    timeZone: 'Asia/Dhaka' // +06 time zone
                };
                const today = new Date('2025-05-23T20:46:00+06:00'); // Latest provided date
                const formattedDate = today.toLocaleString('en-US', options) + ' +06';
                const dateElement = document.getElementById('current-date-time');
                if (dateElement) {
                    dateElement.textContent = formattedDate;
                } else {
                    console.warn('Date element not found');
                }
            } catch (error) {
                console.error('Error updating date:', error);
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            try {
                // Update today's date
                updateTodayDate();

                // Add event listeners to tab buttons
                const tabLinks = document.querySelectorAll('#admissionTabs a[data-toggle="tab"]');
                if (!tabLinks.length) {
                    console.warn('No tab links found');
                    return;
                }

                tabLinks.forEach(link => {
                    link.addEventListener('shown.tab', function(e) {
                        const targetTab = e.target.getAttribute('href').substring(1);
                        showSidebarContent(targetTab);
                    });
                    link.addEventListener('click', function(e) {
                        const targetTab = e.currentTarget.getAttribute('href').substring(1);
                        showSidebarContent(targetTab);
                    });
                });

                // Show undergraduate content by default
                showSidebarContent('undergraduate');
            } catch (error) {
                console.error('Error initializing page:', error);
            }
        });