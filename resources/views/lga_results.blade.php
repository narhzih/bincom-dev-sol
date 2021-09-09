@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <h2><b>LGA results</b></h2>
        <hr>
        <div>
            <form action="#" class="mb-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="state" class="form-label">State*</label>
                            <select name="state" id="state" class="form-control form-select">
                                <option value="#" selected>Select state</option>
                                @foreach($states as $state)
                                    <option value="{{$state->id}}">{{$state->state_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lgas" class="form-label">Lga*</label>
                            <select name="lgaas" id="lgas" class="form-control form-select">
                                <option value="" selected>You need to select a state</option>
{{--                                @foreach($lgas as $lga)--}}
{{--                                    <option value="{{$lga->lga_id}}">{{$lga->lga_name}}</option>--}}
{{--                                @endforeach--}}
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="lga-content d-none" id="resultTable">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr id="partyHead">
                        </tr>
                    </thead>
                    <tbody>
                    <tr id="partyValue">
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="lga-content" id="errorBox">
                <div class="alert alert-warning text-center">
                    <p>Select LGA for result to be displayed</p>
                </div>
            </div>
        </div>
    </div>

    <script>

        const removeView = (type) => {
            if (type === "error") {
                const errorView = document.getElementById('errorBox');
                if (errorView.classList.contains('d-none')) {
                    // do nothing
                }else {
                    errorView.classList.add('d-none');
                }

                return;
            }

            if (type === "result") {
                const resultView = document.getElementById("resultTable");
                if (resultView.classList.contains('d-none')) {
                    // do nothing
                }else {
                    resultView.classList.add('d-none');
                }
            }
        }

        const showView = (type) => {
            if (type === "error") {
                const errorView = document.getElementById('errorBox');
                if (errorView.classList.contains('d-none')) {
                   errorView.classList.remove('d-none');
                }
                return;
            }
            if (type === "result") {
                const resultView = document.getElementById("resultTable");
                if (resultView.classList.contains('d-none')) {
                    resultView.classList.remove('d-none');
                }else {
                    // resultView.classList.add('d-none');
                }
            }
        }
        const refreshTable = () => {
            const tableHeader = document.getElementById('partyHead');
            const tableBody  = document.getElementById('partyValue');
            while(tableHeader.firstChild) {
                tableHeader.removeChild(tableHeader.firstChild);
            }
            while(tableBody.firstChild) {
                tableBody.removeChild(tableBody.firstChild);
            }
        }
        const displayError = (error) => {}
        const displayTable = (data) => {
            removeView('error');
            showView('result');
            refreshTable();
            const resultTable = document.getElementById('resultTable');
            const tableHeader = document.getElementById('partyHead');
            const tableBody  = document.getElementById('partyValue');
            for (const [key, value] of Object.entries(data.parties)) {
                // Dynamically fill table with values
                const headNode = document.createElement('th');
                headNode.innerHTML = `${key}`;
                tableHeader.appendChild(headNode);
                const bodyNode = document.createElement('td');
                bodyNode.innerHTML = `${value}`;
                tableBody.appendChild(bodyNode);
            }
            // Append total to the table
            const totalHeadNode = document.createElement('th');
            totalHeadNode.innerHTML = "TOTAL";
            tableHeader.appendChild(totalHeadNode);
            const totalBodyNode = document.createElement('td');
            totalBodyNode.innerHTML = `${data.total}`;
            tableBody.append(totalBodyNode)
        }

        const monitorStates = (states, lgas) => {
            states.addEventListener('change', function() {
                // Whenever the stage is changed, get the new value;
                let newValue = states.value; // This will be the state ID
                if(newValue === null || newValue === "") {
                    // Display error
                    console.log("No value to be fetched");
                    return;
                }
                fetch(`/lgas/get-list/${newValue}`)
                    .then(response => response.json())
                    .then(data => {
                        const lgasUnderSelectedState = data.data.lgas;
                        if (lgasUnderSelectedState.length > 0) {
                            // console.log(lgasUnderSelectedState);
                            lgas.firstElementChild.innerHTML = "Select LGA";
                            lgasUnderSelectedState.forEach(el => {
                                const newOption = document.createElement('option');
                                newOption.setAttribute('value', el.lga_id);
                                newOption.innerHTML = el.lga_name;
                                lgas.appendChild(newOption);
                            })
                        }else {
                            lgas.firstElementChild.innerHTML = "No LGA under selected state";
                        }
                    })
                    .catch(error => console.log(error))
            })
        }

        const monitorLgas = (lgas) => {
            lgas.addEventListener('change', function() {
                let newValue = lgas.value;
                if (newValue === null || newValue === "") {
                    console.log("No value to be fetched");
                    return
                }

                fetch(`/lgas/get-calculated-result/${newValue}`)
                    .then(response => response.json())
                    .then(data => {
                        displayTable(data.data);
                    })
                    .catch(error => {
                        console.log("An error occurred while trying to fetch data");
                        console.log(error);
                    })
            })
        }

        const startApp = () => {
            let states = document.getElementById('state');
            let lgas = document.getElementById('lgas');
            monitorStates(states, lgas);
            monitorLgas(lgas);
        }

        startApp();

    </script>
@endsection
