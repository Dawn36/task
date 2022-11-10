

      <!--begin::Scroll-->
    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
        <!--begin:::Tabs-->
        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-1">
            <!--begin:::Tab item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_client_details_tab">Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_client_files_tab">Files</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_client_tasks">Tasks</a>
            </li>
            <!--end:::Tab item-->
            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" style="right: 5px;top: -12px;position: absolute;">
                <span class="svg-icon svg-icon-2x">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
                    </svg>
                </span>
            </div>
        </ul>
        <!--end:::Tabs-->
        <!--begin:::Tab content-->
        
        <div class="tab-content" id="myTabContent">
            <!--begin:::Tab pane-->
           
            <div class="tab-pane fade show active" id="kt_client_details_tab" role="tabpanel">
                <div class="card card-flush">
                    <form  method="POST" action="{{ route('client.update',$client->id) }}" >
                        @method("PUT")
                        @csrf
                    <div class="d-flex flex-column scroll-y me-n7 pe-7 pt-10" id="" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-7">
                            <div class="col-lg-6">
                                <label class="required fw-bold fs-6 mb-2">Master Status</label>
                                <select name="master_status" class="form-control form-control-solid mb-3 mb-lg-0" required>
                                    <option value="prospect" {{$client->master_status== 'prospect' ? 'Selected' : ''}}>Prospect</option>
                                    <option value="quoted" {{$client->master_status== 'quoted' ? 'Selected' : ''}}>Quoted</option>
                                    <option value="active client" {{$client->master_status== 'active client' ? 'Selected' : ''}}>Active Client</option>
                                    <option value="closed client" {{$client->master_status== 'closed client' ? 'Selected' : ''}}>Closed Client</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label class="required fw-bold fs-6 mb-2">Client Name</label>
                                <input type="text" name="client_name" value="{{$client->client_name}}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <div class="col-lg-6">
                                <label class="required fw-bold fs-6 mb-2">Contact Name</label>
                                <input type="text" name="contact_name" value="{{$client->contact_name}}" class="form-control form-control-solid mb-3 mb-lg-0" required />
                            </div>
                            <div class="col-lg-6">
                                <label class="required fw-bold fs-6 mb-2">Website</label>
                                <input type="text" name="website" value="{{$client->website}}" class="form-control form-control-solid mb-3 mb-lg-0" required/>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <div class="col-lg-6">
                                <label class="required fw-bold fs-6 mb-2">Phone</label>
                                <input type="number" name="phone" value="{{$client->phone}}" class="form-control form-control-solid mb-3 mb-lg-0" required/>
                            </div>
                            <div class="col-lg-6">
                                <label class="required fw-bold fs-6 mb-2">Email Address</label>
                                <input type="email" name="email_address" value="{{$client->email_address}}" class="form-control form-control-solid mb-3 mb-lg-0" required />
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Account Note</label>
                            <textarea name="account_note" class="form-control form-control-solid mb-3 mb-lg-0" required>{{$client->account_note}}</textarea>
                        </div>
                        <div class="text-center">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <!--end:::Tab pane-->
            <!--begin:::Tab pane-->
            <div class="tab-pane fade " id="kt_client_files_tab" role="tabpanel">
                <div class="card card-flush h-lg-100">
                    <!--begin::Card body-->
                    <div class="card-body pt-10 p-0">
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
                    <!--end::Card body -->
                </div>
            </div>
            <!--end:::Tab pane-->
            <!--begin:::Tab pane-->
            <div class="tab-pane fade " id="kt_client_tasks" role="tabpanel">
                <div class="card card-flush">
                    <div class="card-body d-flex flex-column p-0">
                        <table class="kt_datatable_example_1 table table-row-bordered gy-5">
                            <thead>
                                <tr class="fw-bold fs-6 text-muted">
                                    <th class="w-5px">ID</th>
                                    <th>Status</th>
                                    <th>Client</th>
                                    <th>Task Name</th>
                                    <th class="min-w-250px">Notes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-bold text-gray-600">
                                @for ($i = 0; $i < count($task); $i++) @php $a=$i; $a++; @endphp
                                <tr>
                                    <td>
                                        {{$a}}
                                    </td>
                                    <td>
                                        <div class="badge badge-sm badge-light-info d-inline">{{ucwords($task[$i]->status)}}</div>
                                    </td>
                                    <td>
                                        <a href="#" onclick="showTask('{{$task[$i]->id}}')">{{ucwords($task[$i]->client_name)}}</a>
                                    </td>
                                    <td>{{ucwords($task[$i]->task_name)}}</td>
                                    <td><input type="text" class="form-control form-control-solid m-0"  name="notes" onfocusout="updateTask(this,'{{$task[$i]->id}}')" value="{{$task[$i]->notes}}" /></td>
                                    <td>
                                        <button class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary" data-bs-original-title="Edit Client" onclick="editTask('{{$task[$i]->id}}')">
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                                                </svg>
                                            </span>
                                        </button>
                                        <form  style="display: inline-block" method="POST" action="{{ route('tasks.destroy', $task[$i]->id) }}">
                                            @method('DELETE')
                                            @csrf
                                        <button type="submit" class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger me-2" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                                                </svg>
                                            </span>
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end:::Tab pane-->
        </div>
        <!--end:::Tab content-->
    </div>
