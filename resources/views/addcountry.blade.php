<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Entry Form</title>
    <link rel="stylesheet" href="addcountry.css">
</head>
<body>
    <div class="container">
        <h2>Information Entry Form</h2>
        <form method="POST" action="{{ route('add') }}">
            @csrf

            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" id="code" name="code" required>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="continent">Continent:</label>
                <input type="text" id="continent" name="continent" required>
            </div>

            <div class="form-group">
                <label for="region">Region:</label>
                <input type="text" id="region" name="region" required>
            </div>

            <div class="form-group">
                <label for="surfaceArea">Surface Area:</label>
                <input type="number" id="surfaceArea" name="surfaceArea" required>
            </div>

            <div class="form-group">
                <label for="indepYear">Independence Year:</label>
                <input type="number" id="indepYear" name="indepYear" required>
            </div>

            <div class="form-group">
                <label for="population">Population:</label>
                <input type="number" id="population" name="population" required>
            </div>

            <div class="form-group">
                <label for="lifeExpectancy">Life Expectancy:</label>
                <input type="number" id="lifeExpectancy" name="lifeExpectancy" step="0.1" required>
            </div>

            <div class="form-group">
                <label for="gnp">GNP:</label>
                <input type="number" id="gnp" name="gnp" required>
            </div>

            <div class="form-group">
                <label for="gnpOld">Old GNP:</label>
                <input type="number" id="gnpOld" name="gnpOld" required>
            </div>

            <div class="form-group">
                <label for="localName">Local Name:</label>
                <input type="text" id="localName" name="localName" required>
            </div>

            <div class="form-group">
                <label for="governmentForm">Government Form:</label>
                <input type="text" id="governmentForm" name="governmentForm" required>
            </div>

            <div class="form-group">
                <label for="headOfState">Head of State:</label>
                <input type="text" id="headOfState" name="headOfState" required>
            </div>

            <div class="form-group">
                <label for="capital">Capital:</label>
                <input type="text" id="capital" name="capital" required>
            </div>

            <div class="form-group">
                <label for="code2">Code 2:</label>
                <input type="text" id="code2" name="code2" required>
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
