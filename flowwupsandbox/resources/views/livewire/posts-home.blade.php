<x-post-layout>
    <div class="d-md-flex align-items-md-start">
        <!-- Left sidebar component -->
        <div class="sidebar sidebar-light sidebar-component sidebar-component-left bg-transparent border-0 shadow-0 sidebar-expand-md secondary-sidebar">
            <!-- Sidebar content -->
            <div class="sidebar-content">
                <!-- Sidebar search -->
                <div class="card postbox-full">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Posts</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a href="{{route('post.create')}}" class="list-icons-item"><i class="icon-add"></i></a>
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>
                    <!--BEGIN: Posts List -->
                    @livewire('post-list')
                    <!--END: Posts List -->
                </div>
                <!-- /sidebar search -->
            </div>
            <!-- /sidebar content -->
        </div>
        <!-- /left sidebar component -->

        <!-- Right content -->
        <div class="w-100">
            <!-- BEGIN: Post Detail-->
            @livewire('post-detail')
            <!-- END: Post Detail -->
        </div>
        <!-- /right content -->
    </div>
</x-post-layout>