<h1>Top 10 Countries by Population</h1>
<canvas id="populationChart" width="100" height="100"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Population Chart
        const ctxPopulation = document.getElementById('populationChart').getContext('2d');
        const populationChart = new Chart(ctxPopulation, {
            type: 'pie',
            data: {
                labels: {!! json_encode($countries->sortByDesc('Population')->take(10)->pluck('Name')) !!},
                datasets: [{
                    label: 'Population',
                    data: {!! json_encode($countries->sortByDesc('Population')->take(10)->pluck('Population')) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(199, 199, 199, 0.2)',
                        'rgba(255, 105, 180, 0.2)',
                        'rgba(255, 165, 0, 0.2)',
                        'rgba(0, 128, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(169, 169, 169, 1)',
                        'rgba(255, 105, 180, 1)',
                        'rgba(255, 165, 0, 1)',
                        'rgba(0, 128, 0, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                }
            }
        });

        // Assuming 'initializePagination' is the function setting up pagination
        initializePagination();

        document.addEventListener('DOMContentLoaded', function() {
            searchTable(); // Initialize search and pagination on page load
        });

        function searchTable() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const tableRows = document.querySelectorAll('#tableBody tr');
            let filteredRows = [];

            tableRows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const searchText = cells[0].textContent.toLowerCase(); // Adjusted to search based on the 'Country' column
                if (searchText.includes(searchInput)) {
                    filteredRows.push(row);
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            paginateTable(filteredRows); // Apply pagination on filtered rows
        }

        function paginateTable(filteredRows) {
            const rowsPerPage = 10;
            const rowsCount = filteredRows.length;
            const pageCount = Math.ceil(rowsCount / rowsPerPage);
            const pagination = document.getElementById('pagination');

            // Clear previous pagination
            pagination.innerHTML = '';

            // Setup pagination
            for (let i = 1; i <= pageCount; i++) {
                const btn = document.createElement('button');
                btn.innerText = i;
                btn.addEventListener('click', () => {
                    // Show only the rows for this page
                    filteredRows.forEach((row, index) => {
                        row.style.display = (index >= (i - 1) * rowsPerPage && index < i * rowsPerPage) ? '' : 'none';
                    });
                });
                pagination.appendChild(btn);
            }

            // Initially display the first page
            filteredRows.forEach((row, index) => {
                row.style.display = index < rowsPerPage ? '' : 'none';
            });
        }
    });
</script>
<h2 style="margin-bottom: 10px">Countries and Their Presidents.</h2>
<input type="text" id="searchPresident" style="margin-bottom: 5px " placeholder="Search by country or president..." onkeyup="searchPresidentTable()">
<table id="presidentTable" style="margin-bottom: 10px">
    <thead>
        <tr>
            <th>Country</th>
            <th>President</th>
        </tr>
    </thead>
    <tbody id="presidentTableBody">
        @foreach ($countries as $country)
            <tr>
                <td>{{ $country->Name }}</td>
                <td>{{ $country->HeadOfState }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination" id="presidentPagination" style="margin-bottom: 30px"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        searchPresidentTable(); // Initialize search and pagination on page load
    });

    function searchPresidentTable() {
        const searchInput = document.getElementById('searchPresident').value.toLowerCase();
        const tableRows = document.querySelectorAll('#presidentTableBody tr');
        let filteredRows = [];

        tableRows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const searchText = cells[0].textContent.toLowerCase() + ' ' + cells[1].textContent.toLowerCase();
            row.style.display = searchText.includes(searchInput) ? '' : 'none';
            if (searchText.includes(searchInput)) {
                filteredRows.push(row);
            }
        });

        paginatePresidentTable(filteredRows);
    }

    function paginatePresidentTable(filteredRows) {
        const rowsPerPage = 10;
        const pageCount = Math.ceil(filteredRows.length / rowsPerPage);
        const pagination = document.getElementById('presidentPagination');

        pagination.innerHTML = ''; // Clear previous pagination

        for (let i = 1; i <= pageCount; i++) {
            const btn = document.createElement('button');
            btn.innerText = i;
            btn.addEventListener('click', function() {
                const start = (i - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                filteredRows.forEach((row, index) => {
                    row.style.display = index >= start && index < end ? '' : 'none';
                });
            });
            pagination.appendChild(btn);
        }

        if (pageCount > 0) { // Initially display the first page
            filteredRows.slice(0, rowsPerPage).forEach(row => row.style.display = '');
            filteredRows.slice(rowsPerPage).forEach(row => row.style.display = 'none');
        }
    }
</script>

<h2 style="margin-bottom: 10px">Countries in Their Capitals.</h2>
<input type="text" id="searchCountry" style="margin-bottom: 5px " placeholder="Search by country or capital city..." onkeyup="searchCountryTable()">
<table id="countryTable">
    <thead>
        <tr>
            <th>Country</th>
            <th>Capital City</th>
        </tr>
    </thead>
    <tbody id="countryTableBody">
        @foreach ($countries as $country)
            <tr>
                <td>{{ $country->Name }}</td>
                <td>{{ $cities->firstWhere('ID', $country->Capital)->Name ?? 'N/A' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination" id="countryPagination"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        searchCountryTable(); // Initialize search and pagination on page load
    });

    function searchCountryTable() {
        const searchInput = document.getElementById('searchCountry').value.toLowerCase();
        const tableRows = document.querySelectorAll('#countryTableBody tr');
        let filteredRows = [];

        tableRows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const searchText = cells[0].textContent.toLowerCase() + ' ' + cells[1].textContent.toLowerCase();
            row.style.display = searchText.includes(searchInput) ? '' : 'none';
            if (searchText.includes(searchInput)) {
                filteredRows.push(row);
            }
        });

        paginateCountryTable(filteredRows);
    }

    function paginateCountryTable(filteredRows) {
        const rowsPerPage = 10;
        const pageCount = Math.ceil(filteredRows.length / rowsPerPage);
        const pagination = document.getElementById('countryPagination');

        pagination.innerHTML = ''; // Clear previous pagination

        for (let i = 1; i <= pageCount; i++) {
            const btn = document.createElement('button');
            btn.innerText = i;
            btn.addEventListener('click', function() {
                const start = (i - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                filteredRows.forEach((row, index) => {
                    row.style.display = index >= start && index < end ? '' : 'none';
                });
            });
            pagination.appendChild(btn);
        }

        if (pageCount > 0) { // Initially display the first page
            filteredRows.slice(0, rowsPerPage).forEach(row => row.style.display = '');
            filteredRows.slice(rowsPerPage).forEach(row => row.style.display = 'none');
        }
    }
</script>
