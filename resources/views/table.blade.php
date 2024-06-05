<input type="text" id="search" placeholder="Search..." onkeyup="searchTable()">
<table id="table">
    <thead>
        <tr>
            <th>Code</th>
            <th>Country</th>
            <th>Capital City</th>
            <th>Population</th>
            <th>Continent</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="tableBody">
        @foreach ($countries as $country)
            <tr>
                <td>{{ $country->Code }}</td>
                <td>{{ $country->Name }}</td>
                <td>{{ $cities->firstWhere('ID', $country->Capital)->Name ?? 'N/A' }}</td>
                <td>{{ $country->Population }}</td>
                <td>{{ $country->Continent }}</td>
                <td style="display: flex; justify-content:space-evenly">
                    <button class="action edit" data-toggle="modal" data-target="#editCountryModal{{ $country->Code }}"><i class="fa fa-edit"></i></button>
                    <form method="POST" action="{{ route('delete-country', ['code' => $country->Code]) }}" onsubmit="return confirm('Are you sure you want to delete this country?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action delete"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@include('editcountry')
<div class="pagination" id="pagination"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        searchTable(); // Initialize search and pagination on page load
    });

    function searchTable() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const tableRows = document.querySelectorAll('#tableBody tr');
        let filteredRows = [];

        tableRows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const searchText = cells[1].textContent.toLowerCase(); // Assuming search is based on the 'Country' column
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
</script>
