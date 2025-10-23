@extends('layouts.app')
@section('content')

<div id="heightFormWrapper">
    <form id="heightComparisonForm">
        <div id="personWrapper"></div>

        <button type="button" id="addPerson" class="btn btn-success mt-2">+ Add Person</button>
        <button type="submit" class="btn btn-primary mt-2">Calculate</button>
        <button type="button" id="resetBtn" class="btn btn-secondary mt-2">Reset</button>
    </form>

    <div id="resultContainer" class="mt-4"></div>
</div>

@endsection

@push('scripts')
<script>
    let personCount = 0;
    const maxPersons = 5;

    function addPersonForm() {
        if (personCount >= maxPersons) return alert('Maximum 5 people allowed.');
        personCount++;

        const html = `
            <div class="personForm border p-3 mt-3" data-id="${personCount}">
                <h5>Person ${personCount}</h5>
                <label>Name: <input type="text" name="people[${personCount}][name]" required class="form-control"></label>
                <label>Gender:
                    <select name="people[${personCount}][gender]" class="form-control">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </label>
                <label>Unit:
                    <select name="people[${personCount}][unit]" class="form-control unit-select" data-id="${personCount}">
                        <option value="ft/in">ft/in</option>
                        <option value="cm">cm</option>
                    </select>
                </label>
                <div class="height-ft-in" id="ftin-${personCount}">
                    <label>Feet: <input type="number" name="people[${personCount}][height_ft]" class="form-control"></label>
                    <label>Inches: <input type="number" name="people[${personCount}][height_in]" class="form-control"></label>
                </div>
                <div class="height-cm d-none" id="cm-${personCount}">
                    <label>Centimeters: <input type="number" name="people[${personCount}][height_cm]" class="form-control"></label>
                </div>
                <button type="button" class="btn btn-danger removePerson mt-2">Remove</button>
            </div>
        `;

        $('#personWrapper').append(html);
    }

    $(document).ready(function () {
        addPersonForm(); // Initialize with 1 person

        $('#addPerson').click(addPersonForm);

        $('#personWrapper').on('change', '.unit-select', function () {
            let id = $(this).data('id');
            let unit = $(this).val();
            if (unit === 'ft/in') {
                $(`#ftin-${id}`).removeClass('d-none');
                $(`#cm-${id}`).addClass('d-none');
            } else {
                $(`#ftin-${id}`).addClass('d-none');
                $(`#cm-${id}`).removeClass('d-none');
            }
        });

        $('#personWrapper').on('click', '.removePerson', function () {
            $(this).closest('.personForm').remove();
            personCount--;
        });

        $('#resetBtn').click(function () {
            $('#personWrapper').empty();
            $('#resultContainer').empty();
            personCount = 0;
            addPersonForm();
        });

        $('#heightComparisonForm').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('height.compare') }}",
                type: 'POST',
                data: $(this).serialize(),
                success: function (res) {
                    if (res.status === 'success') {
                        let html = '<h4>Height Comparison Chart</h4><ul class="list-group">';
                        res.data.forEach(p => {
                            html += `<li class="list-group-item">${p.name} (${p.gender}): ${p.height_display}</li>`;
                        });
                        html += '</ul>';
                        $('#resultContainer').html(html);
                    }
                },
                error: function (xhr) {
                    alert(xhr.responseJSON.error || 'Something went wrong');
                }
            });
        });
    });
</script>
@endpush
