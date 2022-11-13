<form id="" class="form" method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
    @csrf
    <!--begin::Input group-->
    <div class="fv-row mb-5">
        <label class="fs-6 required fw-bold form-label mb-2">Task Name</label>
        <input type="text" name="task_name" class="form-control form-control-solid" required />
    </div>
    <div class="fv-row mb-5">
        <label class="fs-6 fw-bold form-label mb-2">Task status</label>
        <select name="status" class="form-control form-control-solid" >
            <option value="not started">Not Started</option>
            <option value="in progress">In Progress</option>
            <option value="on hold">On Hold</option>
            <option value="completed">Completed</option>
        </select>
    </div>
    <div class="fv-row mb-5">
        <label class=" fs-6 fw-bold form-label mb-2">Client</label>
        <select name="client_id" class="form-control form-control-solid rounded-3" data-control="select2" data-dropdown-parent="#kt_modal_add_tasks" data-placeholder="Select an option" data-allow-clear="true">
            @for ($i = 0; $i < count($client); $i++) 
            <option value="{{$client[$i]->id}}">{{ucwords($client[$i]->client_name)}}</option>
            @endfor

        </select>
    </div>
    <div class="fv-row mb-5">
        <label class=" fs-6 fw-bold form-label mb-2">Notes</label>
        <textarea name="notes" class="form-control form-control-solid rounded-3" ></textarea>
    </div>
    <div class="fv-row mb-5">
        <label class=" fs-6 fw-bold form-label mb-2">Additional Details</label>
        <textarea name="additional_details" class="form-control form-control-solid rounded-3" ></textarea>
    </div>
    <div class="fv-row mb-5">
        <label class="fs-6 fw-bold form-label mb-2">Files</label>
        <input type="file" name="files[]" class="form-control form-control-solid rounded-3" multiple>
    </div>
    <div class="text-center pt-15">
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">Submit</button>
    </div>
</form>