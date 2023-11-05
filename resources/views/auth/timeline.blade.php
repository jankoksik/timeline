@extends('auth.layouts')

@section('content')
<style>
.table-container {
            overflow-x: auto; /* Enable horizontal scrolling */
        }
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  border: 0;
  background-color: #dddddd;
}

td, th {
  border: 0px solid #dddddd;
  width: 500px;
  height: 100px;
  text-align: center;
  padding: 8px;
}

</style>
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
          
        <div style="overflow-x:auto;">  

            @if($page > 0)
            <button class="btn btn-light no-print" onclick="location.href='/?page={{$page-1}}'" type="button"><-</button>
            @endif
            <button class="btn btn-light no-print"  onclick="location.href='/?page={{$page+1}}'" type="button">-></button>
            <table >

                
                @foreach ($timeline as $row)
                <tr>
                    @foreach ($row as $timeplace)
                    @if($timeplace->getEvent())
                        <td class="" id="{{$timeplace->getEvent()->id}}-click" style="background-color:{{$timeplace->getEvent()->type->color}}" colspan="{{$timeplace->getSpan()}}"> 
                          <div>{{$timeplace->getEvent()->name }}</div>
                          <div>{{$timeplace->getEvent()->type->name }}</div>
                        </td>
                        <div class="modal fade" id="{{$timeplace->getEvent()->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">{{$timeplace->getEvent()->name }}</h5>
                                 
                                </div>
                                <div class="modal-body">
                                    <div>Event Type : {{$timeplace->getEvent()->type->name }} </div>
                                    
                                    <hr>
                                    <div style="word-break: break-all;"> {{$timeplace->getEvent()->description }}</div>
                                </div>
                                @auth
                                
                                @if (Auth::user()->id == $timeplace->getEvent()->user->id)
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="location.href='/modify/{{$timeplace->getEvent()->id}}'" >Modify</button>
                                    <form method="POST" action="{{ route('events.destroy', ['id' => $timeplace->getEvent()->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" data-dismiss="modal" >Delete</button>
                                    </form>   
                                </div>
                                @endif
                                @endauth
                              </div>
                            </div>
                          </div>
                          <script>
                            $(document).ready(function () {
                              $("#{{$timeplace->getEvent()->id}}-click").click(function () {
                                $("#{{$timeplace->getEvent()->id}}").modal("show");
                              });
                            });
                          </script>
                          
                    @else
                        <td class="" colspan="{{$timeplace->getSpan()}}"></td>
                    @endif
                    @endforeach
                </tr>
                @endforeach
                
                
                <tr>
                @foreach ($days as $day)
                    <td>{{$day}}</td>
                @endforeach
                </tr>

                

            </table>
            
        </div>
        </div>


    </body>

</html>
@endsection