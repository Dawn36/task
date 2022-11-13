@extends('layouts.main')

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">

            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <div class="col-xl-12 mb-5 mb-xl-10">
                    <!--begin::Card-->
                    <div class="card card-docs mb-2">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <input type="text" id="search" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search" />
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--begin::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                    <!--begin::Tasks-->
                                    <button type="button" class="btn btn-primary me-2" onclick="addTask()">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->Add Tasks
                                    </button>
                                    <!--end::Tasks-->
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card Body-->
                        <div class="card-body fs-6 py-lg-5 text-gray-700">

                            <!--begin::Block-->
                            <div class="py-5">
                                <table class="kt_datatable_example_2 table table-row-bordered gy-5">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-muted">
                                            <th  hidden>ID</th>
                                            <th class="w-5px" ></th>
                                            <th>Status</th>
                                            <th>Client</th>
                                            <th>Task Name</th>
                                            <th class="min-w-250px">Notes</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-bold text-gray-600">
                                        @for ($i = 0; $i < count($task); $i++) @php $a=$i; $a++;  $taskId=$task[$i]->task_id; @endphp
                                        <tr id="table-{{$taskId}}">
                                            <td hidden>
                                                {{$taskId}}
                                            </td>
                                            <td>
                                                <div class="symbol symbol-20px cursor-pointer">
                                                    <img alt="Icon" src="{{ asset('theme/assets/media/svg/files/drag.png')}}">
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-icon btn-active-light- w-30px h-30px ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    <div class="badge badge-sm badge-light-info d-inline">{{ucwords($task[$i]->status)}}</div>
                                                </button>
                                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                                    <div class="px-7 py-5">
                                                        <div class="fs-5 text-dark fw-bolder">Update Status</div>
                                                    </div>
                                                    <div class="separator border-gray-200"></div>
                                                    <form class="form px-7 py-5" method="POST" action="{{ route('tasks.update',$task[$i]->id) }}" data-kt-menu-id="kt-users-tasks-form">
                                                        @method("PUT")
                                                        @csrf
                                                        <div class="fv-row mb-10">
                                                            <label class="form-label fs-6 fw-bold">Status:</label>
                                                            <select class="form-select form-select-solid" name="status" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-hide-search="true">
                                                                <option></option>
                                                                <option value="not started" {{$task[$i]->status == 'not started' ? "Selected" : ''}}>Not Started</option>
                                                                <option value="in progress" {{$task[$i]->status == 'in progress' ? "Selected" : ''}}>In Progress</option>
                                                                <option value="on hold" {{$task[$i]->status == 'on hold' ? "Selected" : ''}}>On Hold</option>
                                                                <option value="completed" {{$task[$i]->status == 'completed' ? "Selected" : ''}}>Completed</option>
                                                            </select>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-sm btn-primary">Apply</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" onclick="showTask('{{$task[$i]->id}}')">{{ucwords($task[$i]->client_name)}}</a>
                                            </td>
                                            <td > <a href="#" onclick="showTask('{{$task[$i]->id}}')">{{ucwords($task[$i]->task_name)}}</a></td>
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
                        <!--end::Card Body-->
                    </div>
                    <!--end::Card-->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<script>
     $(document).ready(function() {
        // Datatables
        var table2 = $('.kt_datatable_example_2').DataTable({
            rowReorder:{ selector: 'td:nth-child(2)',
                    }
                    
        });
        table2.on('row-reorder', function ( e, details, edit ) {
        console.log(edit.values);
        tableSwap(JSON.stringify(edit.values));

    });
    });
    function tableSwap(json) {
        var value = {
            json: json,
        };
    $.ajax({
        type: 'GET',
        url: "{{ route('tasks_update_table') }}",
        data: value,
        success: function(result) {
           console.log(result);
        }
    });
}
    </script>
@endsection('content')