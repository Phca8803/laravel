Page {{ $data->currentPage() }} of {{ $data->lastPage()}}.
<ul class="pagination pull-right">
    {{ $data->appends(Request::query())->links() }}
</ul>