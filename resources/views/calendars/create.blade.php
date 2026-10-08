
<x-layout>
    <div class="page-wrapper" style="padding-top: 0px;">
        <div class="content container-fluid">
    
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Add Calendar Entry</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Calendar Entry</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('calendars.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Month</label>
                                    <input type="text" class="form-control" name="month" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" name="date" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Day</label>
                                    <input type="text" class="form-control" name="days" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Activity/Description</label>
                                    <textarea class="form-control" name="activity"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Holiday</label>
                                    <select class="form-control" name="holidays" required>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Working Details</label>
                                    <input type="text" class="form-control" name="working_details">
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
</x-layout>

