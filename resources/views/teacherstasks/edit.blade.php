<x-layout>
    <div class="container">
        <div class="d-flex flex-row justify-content-between">
            <h2 class="">Update lesson plan</h2>
            <a href="{{ route('teacherstasks.index') }}" class="btn btn-primary">Back</a>
        </div>
        @if (session('success'))
            <x-flashMsg msg="{{ session('success') }}" bg="bg-success" />
        @elseif(session('failed'))
            <x-flashMsg msg="{{ session('failed') }}" bg="bg-danger" />
        @endif
        <form action="{{ route('teacherstasks.update', $teacherstask) }}" method="POST" class="form-floating">
            @csrf
            @method('PUT')
            <div class="d-flex flex-column gap-3">

                <div class="row">
                    <div class="col">
                        <table id="plansList">
                            <thead>
                                <th style="width:5%">sl no.</th>
                                <th style="width:85%">Task</th>
                                <th style="width:10%"></th>
                            </thead>
                            <tbody>
                                {{-- {{$teacherstask->tasks}} --}}
                                @php
                                    $i = 0;
                                    $metas = unserialize($teacherstask->tasks);
                                    // dd($metas);
                                @endphp
                                @foreach ($metas as $value)
                                    @php
                                        $i++;
                                        $checkedAt = $value["checkedAt_$i"];
                                        $content = $value["content_$i"];
                                    @endphp

                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            {!! $content !!}
                                            <input type="hidden" class="content"
                                                name="content_{{ $i }}" value='{!! $content !!}'>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="taskCheckerBox"
                                                name="taskCheckerBox_{{ $i }}"
                                                class="form-check-input taskChecker" @if ($checkedAt != "") checked @endif>
                                            <input type="hidden" class="checkedAt"
                                                name="checkedAt_{{ $i }}" value="{{$checkedAt}}" >
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col p-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let taskChecker = document.getElementsByClassName("taskCheckerBox");
                Array.from(taskChecker).forEach((item) => {
                    item.addEventListener("change", () => {
                        const currentTime = new Date().toISOString();
                        if (item.checked) {
                            item.setAttribute("checkedTime", currentTime);
                            item.parentElement.querySelector(".checkedAt").value = currentTime;
                            console.log("checked!");
                        } else {
                            item.removeAttribute("checkedTime");
                            console.log("Unchecked!");
                        }
                    });
                });
            });
        </script>
    @endpush

</x-layout>