const calendarData = {
    currentSemester: {
        title: "Fall 2025",
        events: [
            { date: "Aug 15", event: "Registration Begins", type: "registration" },
            { date: "Sep 01", event: "Classes Begin", type: "academic" },
            { date: "Oct 15-20", event: "Midterm Examinations", type: "exam" },
            { date: "Nov 10-12", event: "Fall Career Fair", type: "event" },
            { date: "Dec 20-30", event: "Final Examinations", type: "exam" }
        ]
    },
    nextSemester: {
        title: "Spring 2026",
        events: [
            { date: "Jan 10", event: "Registration Begins", type: "registration" },
            { date: "Feb 01", event: "Classes Begin", type: "academic" },
            { date: "Mar 15-20", event: "Midterm Examinations", type: "exam" },
            { date: "Apr 10-12", event: "Spring Career Fair", type: "event" },
            { date: "May 20-30", event: "Final Examinations", type: "exam" }
        ]
    },
    upcomingSemester: {
        title: "Summer 2026",
        events: [
            { date: "May 25", event: "Registration Begins", type: "registration" },
            { date: "Jun 10", event: "Classes Begin", type: "academic" },
            { date: "Jul 15-20", event: "Midterm Examinations", type: "exam" },
            { date: "Aug 20-30", event: "Final Examinations", type: "exam" }
        ]
    }
};

function createCalendarEvent(event) {
    return `
        <div class="calendar-event" data-type="${event.type.toLowerCase()}">
            <div class="event-date">${event.date}</div>
            <div class="event-detail">
                <div class="event-name">${event.event}</div>
                <span class="event-type">${capitalizeFirstLetter(event.type)}</span>
            </div>
        </div>
    `;
}

function loadAcademicCalendar() {
    const calendarAccordion = document.getElementById('calendarAccordion');
    if (!calendarAccordion) return;

    Object.entries(calendarData).forEach(([key, semester], index) => {
        const semesterSection = document.createElement('div');
        semesterSection.className = 'calendar-card mb-3';
        semesterSection.innerHTML = `
            <div class="calendar-header">
                <button class="btn calendar-btn ${index === 0 ? 'active' : ''}" 
                        data-toggle="collapse" 
                        data-target="#collapse${key}">
                    <span>${semester.title}</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>
            <div id="collapse${key}" 
                 class="collapse ${index === 0 ? 'show' : ''}"
                 data-parent="#calendarAccordion">
                <div class="calendar-body">
                    ${semester.events.map(event => createCalendarEvent(event)).join('')}
                </div>
            </div>
        `;
        calendarAccordion.appendChild(semesterSection);
    });
}

function getEventIcon(type) {
    const icons = {
        registration: 'fa-edit',
        academic: 'fa-book',
        exam: 'fa-file-alt',
        event: 'fa-calendar-day'
    };
    return `fas ${icons[type] || 'fa-calendar'}`;
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}