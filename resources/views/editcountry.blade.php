@foreach($countries as $country)
<div class="modal fade" id="editCountryModal{{$country->Code}}" tabindex="-1" role="dialog" aria-labelledby="editCountryModalLabel{{$country->Code}}" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCountryModalLabel{{$country->Code}}">Edit Country Details</h5>
            </div>
            <div class="modal-body">
                <form id="editCountryForm{{$country->Code}}" method="POST" action="{{ route('editCountry', ['code' => $country->Code]) }}">
                    @method('PUT')
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="code{{$country->Code}}">Code:</label>
                            <input type="text" id="code{{$country->Code}}" name="code" value="{{$country->Code}}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="name{{$country->Code}}">Name:</label>
                            <input type="text" id="name{{$country->Code}}" name="name" value="{{$country->Name}}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="continent{{$country->Code}}">Continent:</label>
                            <input type="text" id="continent{{$country->Code}}" name="continent" value="{{$country->Continent}}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="region{{$country->Code}}">Region:</label>
                            <input type="text" id="region{{$country->Code}}" name="region" value="{{$country->Region}}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="surfaceArea{{$country->Code}}">Surface Area:</label>
                            <input type="number" id="surfaceArea{{$country->Code}}" name="surfaceArea" value="{{$country->SurfaceArea}}" step="0.01" required>
                        </div>
                
                        <div class="form-group">
                            <label for="indepYear{{$country->Code}}">Independence Year:</label>
                            <input type="number" id="indepYear{{$country->Code}}" name="indepYear" value="{{$country->IndepYear}}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="population{{$country->Code}}">Population:</label>
                            <input type="number" id="population{{$country->Code}}" name="population" value="{{$country->Population}}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="lifeExpectancy{{$country->Code}}">Life Expectancy:</label>
                            <input type="number" id="lifeExpectancy{{$country->Code}}" name="lifeExpectancy" value="{{$country->LifeExpectancy}}" step="0.1" required>
                        </div>
                
                        <div class="form-group">
                            <label for="gnp{{$country->Code}}">GNP:</label>
                            <input type="number" id="gnp{{$country->Code}}" name="gnp" value="{{$country->GNP}}" step="0.01" required>
                        </div>
                
                        <div class="form-group">
                            <label for="gnpOld{{$country->Code}}">Old GNP:</label>
                            <input type="number" id="gnpOld{{$country->Code}}" name="gnpOld" value="{{$country->GNPOld}}" step="0.01" required>
                        </div>
                
                        <div class="form-group">
                            <label for="localName{{$country->Code}}">Local Name:</label>
                            <input type="text" id="localName{{$country->Code}}" name="localName" value="{{$country->LocalName}}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="governmentForm{{$country->Code}}">Government Form:</label>
                            <input type="text" id="governmentForm{{$country->Code}}" name="governmentForm" value="{{$country->GovernmentForm}}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="headOfState{{$country->Code}}">Head of State:</label>
                            <input type="text" id="headOfState{{$country->Code}}" name="headOfState" value="{{$country->HeadOfState}}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="capital{{$country->Code}}">Capital:</label>
                            <input type="number" id="capital{{$country->Code}}" name="capital" value="{{$country->Capital}}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="code2{{$country->Code}}">Code 2:</label>
                            <input type="text" id="code2{{$country->Code}}" name="code2" value="{{$country->Code2}}" required>
                        </div>
                    </div>
                
                    <button class="edit-button" type="submit">Save</button>
                </form>
                   
            </div>
        </div>
    </div>
</div>
@endforeach
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


