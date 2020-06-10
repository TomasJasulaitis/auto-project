<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>

            .clickable-th {
                cursor: pointer;
            }
            .button-w300 {
                width: 300px;
            }
            .justify-content-space-between {
                justify-content: space-between;
            }
        </style>
    </head>
    <body>

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
                    <div class="d-flex justify-content-center mt-4">
                        {{$data->links()}}
                    </div>
                </tfoot>
            </div>
        </div>
    </body>
</html>
