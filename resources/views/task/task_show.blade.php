<form id="" class="form" method="POST" action="{{ route('tasks.update',$task->id) }}" enctype="multipart/form-data">
    @method("PUT")
    @csrf
    <!--begin::Input group-->
    <div class="row">
        <div class="col-lg-6">
            <div class="fv-row mb-5">
                <label class="fs-6 required fw-bold form-label mb-2">Task Name</label>
                <input type="text" name="task_name" value="{{$task->task_name}}" class="form-control form-control-solid" required />
            </div>
            <div class="fv-row mb-5">
                <label class="fs-6 fw-bold form-label mb-2">Task status</label>
                <select name="status" class="form-control form-control-solid" >
                    <option value="not started" {{$task->status == 'not started' ? 'Selected' : ''}}>Not Started</option>
                    <option value="in progress" {{$task->status == 'in progress' ? 'Selected' : ''}}>In Progress</option>
                    <option value="on hold" {{$task->status == 'on hold' ? 'Selected' : ''}}>On Hold</option>
                    <option value="completed" {{$task->status == 'completed' ? 'Selected' : ''}}>Completed</option>
                </select>
            </div>
            <div class="fv-row mb-5">
                <label class=" fs-6 fw-bold form-label mb-2">Client</label>
                <select name="client_id" class="form-control form-control-solid rounded-3" data-control="select2" data-dropdown-parent="#kt_modal_add_tasks" data-placeholder="Select an option" data-allow-clear="true">
                    @for ($i = 0; $i < count($client); $i++) 
                    <option value="{{$client[$i]->id}}" {{$task->client_id == $client[$i]->id ? 'Selected' : ''}}>{{ucwords($client[$i]->client_name)}}</option>
                    @endfor
        
                </select>
            </div>
            <div class="fv-row mb-5">
                <label class=" fs-6 fw-bold form-label mb-2">Notes</label>
                <textarea name="notes" class="form-control form-control-solid rounded-3" >{{$task->notes}}</textarea>
            </div>
            <div class="fv-row mb-5">
                <label class=" fs-6 fw-bold form-label mb-2">Additional Details</label>
                <textarea name="additional_details" class="form-control form-control-solid rounded-3" >{{$task->additional_details}}</textarea>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="fv-row mb-5">
                <label class="fs-3 fw-bolder form-label mb-2">Files</label>
                <div class="card-body p-0">
                    <!--begin::Files-->
                    <div class="d-flex flex-column mb-9" style="overflow: auto;height: 355px;">
                        <!--begin::File-->
                        @for ($i = 0; $i < count($taskFile); $i++)
                        <div class="d-flex align-items-center mb-5">
                            <div class="symbol symbol-30px me-5">
                                <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-10-09-043348/core/html/src/media/icons/duotune/files/fil023.svg-->
                                <a href="{{ asset($taskFile[$i]->path)}}" ><span class="svg-icon  svg-icon-2hx  svg-icon-primary">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M5 15C3.3 15 2 13.7 2 12C2 10.3 3.3 9 5 9H5.10001C5.00001 8.7 5 8.3 5 8C5 5.2 7.2 3 10 3C11.9 3 13.5 4 14.3 5.5C14.8 5.2 15.4 5 16 5C17.7 5 19 6.3 19 8C19 8.4 18.9 8.7 18.8 9C18.9 9 18.9 9 19 9C20.7 9 22 10.3 22 12C22 13.7 20.7 15 19 15H5ZM5 12.6H13L9.7 9.29999C9.3 8.89999 8.7 8.89999 8.3 9.29999L5 12.6Z" fill="currentColor"/>
                                    <path d="M17 17.4V12C17 11.4 16.6 11 16 11C15.4 11 15 11.4 15 12V17.4H17Z" fill="currentColor"/>
                                    <path opacity="0.3" d="M12 17.4H20L16.7 20.7C16.3 21.1 15.7 21.1 15.3 20.7L12 17.4Z" fill="currentColor"/>
                                    <path d="M8 12.6V18C8 18.6 8.4 19 9 19C9.6 19 10 18.6 10 18V12.6H8Z" fill="currentColor"/>
                                    </svg>
                                    </span></a>
                                    <!--end::Svg Icon-->
                            </div>
                            <div class="fw-bold">
                                <a class="fs-6 fw-bolder text-dark text-hover-primary" href="{{ asset($taskFile[$i]->path)}}">{{$taskFile[$i]->file_name}}</a>
                                <div class="text-gray-400">{{DATE('Y-m-d',strtotime($taskFile[$i]->created_at))}}
                                </div>
                            </div>
                        </div>
                        @endfor

                    </div>
                    <!--end::Files-->
                </div>
                <input type="file" name="files[]" class="form-control form-control-solid rounded-3" multiple>
            </div>
        </div>
    </div>
    <!--end::Input group-->
    <!--begin::Actions-->
    <div class="text-center pt-15">
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">Submit</button>
    </div>
    <!--end::Actions-->
</form>