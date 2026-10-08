
<x-layout>
    <div class="page-wrapper" style="position: absolute !important; top: 10px !important; width: 80%;">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Add Subject</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="subjects.html">Subject</a></li>
                            <li class="breadcrumb-item active">Add Subject</li>
                        </ul>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('subjects.update',$subject) }}" method="POST">
                                @csrf
                                @method("PUT")
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Subject Information</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Subject Name <span class="login-danger">*</span></label>
                                            <input type="text" id="subject" name="subject" required
                                                class="form-control @error('subject') border-danger @enderror" value="{{ $subject->subject }}">   
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    </x-layout>

    