<x-intern-layout-app>
    @section('title', 'Goals!')

    <x-intern-layout-header judul="What's Your Goals Today?"></x-intern-layout-header>
    <div class="col-12">
        @if (Session::get('success'))
            <div id="alert_demo_3_3"></div>
        @endif

        @if (Session::get('warning'))
            <div id="alert_demo_3_2"></div>
        @endif
    </div>
    <!-- Icon below header -->
    <div class="text-center my-3 p-3">
        <i class="fas fa-bullseye text-danger" style="font-size: 5rem; cursor: pointer;" id="goalsIcon"
            onclick="openGoalsModal()"></i>
        <p class="mt-2 text-muted" style="font-size: 1rem;">Click the icon above to set your goals</p>
    </div>

    <!-- Modal for goals -->
    <div class="modal fade" id="goalsModal" tabindex="-1" aria-labelledby="goalsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="goalsModalLabel">Set Today's Goals</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="goalsForm" action="{{ route('intern.goal.store') }}" method="POST">
                        @csrf <!-- Laravel CSRF protection -->
                        <!-- Textbox for today's goals -->
                        <div class="mb-3">
                            <label for="goalsText" class="form-label">Today's Goals</label>
                            <input type="text" class="form-control" id="goalsText" name="description"
                                placeholder="Enter today's goals" required>
                        </div>

                        <!-- Dropdown for status -->
                        <div class="mb-3">
                            <label for="statusSelect" class="form-label">Status</label>
                            <select class="form-select" id="statusSelect" name="status" required>
                                <option value="In Progress">In Progress</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-2">
        {{-- Today's Goals --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Today <span class="text-primary" id="goalCountToday">({{ $goalsToday->count() }})</span></span>
                <button class="btn btn-sm" data-bs-toggle="collapse" data-bs-target="#goalsTodayCard"
                    aria-expanded="false" aria-controls="goalsTodayCard">
                    <i class="fas fa-chevron-down" id="toggleIconGoalsToday"></i>
                </button>
            </div>

            <div class="collapse" id="goalsTodayCard">
                <div class="card-body">
                    @if ($goalsToday->isEmpty())
                        <p>No goals for today.</p>
                    @else
                        @php $goal = $goalsToday->first(); @endphp <!-- Get the first (and only) goal -->
                        <p class="d-flex align-items-center justify-content-between">
                            <span>
                                {{ $goal->description }} - Status:
                            </span>
                        <div class="d-flex align-items-center">
                            <select class="form-select form-select-sm ms-2" id="statusSelect"
                                onchange="saveStatus({{ $goal->id }})">
                                <option value="In Progress" {{ $goal->status == 'In Progress' ? 'selected' : '' }}>In
                                    Progress</option>
                                <option value="Done" {{ $goal->status == 'Done' ? 'selected' : '' }}>Done</option>
                            </select>
                            <button class="btn btn-primary btn-sm ms-2"
                                onclick="saveStatus({{ $goal->id }})">Save</button>
                        </div>
                        </p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Completed Goals --}}
        <div class="card mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Completed<span class="text-success" id="goalCountDone">({{ $goalsDone->count() }})</span></span>
                <button class="btn btn-sm" data-bs-toggle="collapse" data-bs-target="#goalsDoneCard"
                    aria-expanded="false" aria-controls="goalsDoneCard">
                    <i class="fas fa-chevron-down" id="toggleIconGoalsDone"></i>
                </button>
            </div>
            <div class="collapse" id="goalsDoneCard">
                <div class="card-body">
                    @if ($goalsDone->isEmpty())
                        <p>No completed goals.</p>
                    @else
                        <ul>
                            @foreach ($goalsDone as $goal)
                                <li>{{ $goal->description }} - Status: {{ $goal->status }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="calendar">
            <div class="calendar-header d-flex justify-content-between align-items-center">
                <button class="btn btn-primary" onclick="prevMonth()">&#8592;</button>
                <h3 id="monthYear"></h3>
                <button class="btn btn-primary" onclick="nextMonth()">&#8594;</button>
            </div>
            <div class="calendar-body">
                <div class="day-names">
                    <span>Sun</span><span>Mon</span><span>Tue</span><span>Wed</span>
                    <span>Thu</span><span>Fri</span><span>Sat</span>
                </div>
                <div class="days" id="calendarDays"></div>
            </div>
        </div>

        <style>
            .calendar {
                max-width: 100%;
                margin: auto;
                border: 1px solid #ddd;
                padding: 10px;
                border-radius: 8px;
            }

            .calendar-header {
                text-align: center;
                margin-bottom: 20px;
            }

            .day-names {
                display: grid;
                grid-template-columns: repeat(7, 1fr);
                font-weight: bold;
                text-align: center;
            }

            .days {
                display: grid;
                grid-template-columns: repeat(7, 1fr);
                grid-gap: 5px;
            }

            .day {
                height: 100px;
                text-align: center;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 8px;
                position: relative;
            }

            .day .event {
                background-color: #e0f7fa;
                border-radius: 4px;
                padding: 5px;
                font-size: 12px;
                position: absolute;
                bottom: 5px;
                left: 5px;
                right: 5px;
                text-align: center;
            }
        </style>

        <script>
            let currentMonth = new Date().getMonth();
            let currentYear = new Date().getFullYear();

            // Combine today's goals and done goals into events for the calendar
            const activities = @json(
                $goalsToday->concat($goalsDone)->map(function ($goal) {
                    return ['date' => $goal->created_at->format('Y-m-d'), 'title' => $goal->description];
                }));

            function showCalendar(month, year) {
                const calendarDays = document.getElementById("calendarDays");
                calendarDays.innerHTML = "";
                const monthYear = document.getElementById("monthYear");
                const firstDay = new Date(year, month).getDay();
                const daysInMonth = 32 - new Date(year, month, 32).getDate();

                monthYear.innerHTML = new Date(year, month).toLocaleString('en-US', {
                    month: 'long',
                    year: 'numeric'
                });

                // Adding empty cells for days before the 1st
                for (let i = 0; i < firstDay; i++) {
                    const emptyCell = document.createElement('div');
                    calendarDays.appendChild(emptyCell);
                }

                // Loop through all days in the month
                for (let day = 1; day <= daysInMonth; day++) {
                    const date = `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
                    const dayCell = document.createElement('div');
                    dayCell.classList.add('day');
                    dayCell.innerHTML = day;

                    // Loop through activities array to find matching events
                    activities.forEach(event => {
                        if (event.date === date) {
                            dayCell.innerHTML += `<div class="event">${event.title}</div>`;
                        }
                    });

                    calendarDays.appendChild(dayCell);
                }
            }

            function prevMonth() {
                if (currentMonth === 0) {
                    currentMonth = 11;
                    currentYear--;
                } else {
                    currentMonth--;
                }
                showCalendar(currentMonth, currentYear);
            }

            function nextMonth() {
                if (currentMonth === 11) {
                    currentMonth = 0;
                    currentYear++;
                } else {
                    currentMonth++;
                }
                showCalendar(currentMonth, currentYear);
            }

            // Initial calendar display
            showCalendar(currentMonth, currentYear);

            function openGoalsModal() {
                const goalsModal = new bootstrap.Modal(document.getElementById('goalsModal'));
                goalsModal.show();
            }

            function saveStatus(goalId) {
                const statusSelect = document.querySelector(`#statusSelect`);
                const status = statusSelect.value;
                // Make an AJAX request to update the goal status
                fetch(`/intern/goals/${goalId}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            status: status
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Success!', 'Goal status updated.', 'success');
                            // Update the goal count or refresh the calendar if necessary
                        } else {
                            Swal.fire('Error!', 'Failed to update goal status.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'An error occurred while updating.', 'error');
                    });
            }
        </script>
        <x-intern-alert></x-intern-alert>
</x-intern-layout-app>
