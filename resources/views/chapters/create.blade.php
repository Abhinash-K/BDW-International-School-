<div class="form-group">
    <label for="class_id">Class:</label>
    <select id="class_id" name="class_id" class="form-control">
        <option value="">Select Class</option>
        @foreach ($classes as $class)
            <option value="{{ $class->id }}">{{ $class->class }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="section_id">Sections:</label>
    @foreach ($sections as $section)
        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
    @endforeach
    <!--<select id="section_id" name="section_id[]" class="form-control" multiple>-->
        <!-- Sections will be dynamically loaded -->
    </select>
</div>

<div id="section_dates"></div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const classDropdown = document.getElementById('class_id');
    const sectionDropdown = document.getElementById('section_id');
    const sectionDatesDiv = document.getElementById('section_dates');

    // Fetch sections based on class selection
    classDropdown.addEventListener('change', function() {
        let classId = this.value;
        sectionDropdown.innerHTML = "";
        sectionDatesDiv.innerHTML = "";

        if (classId) {
            fetch(`/get-sections/${classId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        data.forEach(section => {
                            let option = document.createElement('option');
                            option.value = section.id;
                            option.textContent = section.section_name;
                            sectionDropdown.appendChild(option);
                        });
                    } else {
                        sectionDropdown.innerHTML = "<option value=''>No sections available</option>";
                    }
                })
                .catch(error => console.error('Error fetching sections:', error));
        }
    });

    // Generate start & end date fields when sections are selected
    sectionDropdown.addEventListener('change', function() {
        sectionDatesDiv.innerHTML = "";
        Array.from(this.selectedOptions).forEach(option => {
            let sectionBlock = document.createElement('div');
            sectionBlock.classList.add('form-group', 'mt-2', 'p-2', 'border', 'rounded');

            sectionBlock.innerHTML = `
                <label><strong>${option.text} - Actual Start Date:</strong></label>
                <input type="date" name="actual_start_date[${option.value}]" class="form-control mb-2" required>

                <label><strong>${option.text} - Actual End Date:</strong></label>
                <input type="date" name="actual_end_date[${option.value}]" class="form-control" required>
            `;

            sectionDatesDiv.appendChild(sectionBlock);
        });
    });
});
</script>
