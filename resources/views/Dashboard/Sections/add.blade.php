<!--####################### Modal Add############################-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                {{ __('section_t.New Section') }}</h5>
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('sections.store') }}" method="post"
                autocomplete="off">
                @csrf
                <label>{{ __('section_t.اسم القسم') }}</label>
                <input type="text" name="name" class="form-control">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('section_t.close') }}</button>
                    <button type="submit"
                        class="btn btn-primary">{{ __('section_t.Add') }}</button>
                </div>
            </form>
        </div>

    </div>
</div>
</div>
