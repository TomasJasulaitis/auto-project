@extends('layout.master')
@section ('content')
    <div class="flex-center position-ref ml-5 mr-5 mt-5">

        @if(Request::input('success', 0)) 
            <div class="alert alert-success" role="alert">
                Successfully created a new record. Id: {{Request::input('id', 0)}}
            </div>
        @endif

        
        <div class="content">
            <div class="mb-3 d-flex  justify-content-space-between">
                <a href="{{route('trucks.index')}}/create" class="btn btn-primary btn-lg active mr-5 button-w300" role="button" aria-pressed="true">Create new</a>

                <form class="form-inline ml-auto">
                    <div class="md-form my-0">
                        <input class="form-control" type="text" placeholder="Search" aria-label="Search" name="search" value={{Request::input('search', '')}}>
                    </div>
                    <button href="#" class="btn btn-outline-white btn-md my-0 ml-sm-2" type="submit">Search</button>
                </form>
            </div>
            

        <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th class="clickable-th" scope="col">
                        @if(Request::input('orderBy','desc') == 'desc')
                            <a href="{{route('trucks.index')}}?sort=model.title&orderBy=asc">
                                Model
                            </a>
                        @else
                            <a href="{{route('trucks.index')}}?sort=model.title&orderBy=desc">
                                Model
                            </a>
                        @endif
                    </th>

                    <th class="clickable-th" scope="col">
                        @if(Request::input('orderBy','desc') == 'desc')
                            <a href="{{route('trucks.index')}}?sort=manufacture_date&orderBy=asc">
                                Manufacture date
                            </a>
                        @else
                            <a href="{{route('trucks.index')}}?sort=manufacture_date&orderBy=desc">
                                Manufacture date
                            </a>
                        @endif
                    </th>

                    <th class="clickable-th" scope="col">
                        @if(Request::input('orderBy','asc') == 'desc')
                            <a href="{{route('trucks.index')}}?sort=owner_count&orderBy=asc">
                            Owner count
                            </a>
                        @else
                            <a href="{{route('trucks.index')}}?sort=owner_count&orderBy=desc">
                                Owner count
                            </a>
                        @endif
                    </th>

                    <th class="clickable-th" scope="col">
                        @if(Request::input('orderBy','desc') == 'desc')
                            <a href="{{route('trucks.index')}}?sort=owner.first_name&orderBy=asc">
                            Owner
                            </a>
                        @else
                            <a href="{{route('trucks.index')}}?sort=owner.first_name&orderBy=desc">
                                Owner
                            </a>
                        @endif
                    </th>

                    <th scope="col">Comments</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @if($data)
                        @foreach($data as $truckItem)
                            <tr>
                                <th scope="row">{{$truckItem->id}}</th>
                                <td>
                                    {{$truckItem->model->title}}
                                </td>
                                <td>{{$truckItem->manufacture_date}}</td>
                            
                                <td>{{$truckItem->owner_count}}</td>

                                <td>
                                    @if ($truckItem->owner)
                                        {{$truckItem->owner->full_name}}
                                    @endif
                                </td>
                                <td>
                                    @if ($truckItem->comments)
                                        @foreach($truckItem->comments as $coment)
                                            <div>
                                                {{$coment->content}}
                                            </div>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            
            </table>
            <tfoot>
                <div class="d-flex justify-content-center mt-4 mb-4">
                    {{$data->links()}}
                </div>
            </tfoot>
        </div>
    </div>
@endsection
