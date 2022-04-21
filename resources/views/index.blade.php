@extends('layouts.app')

@section('content')
    <div id="content" class="container">
        <div class="helper">

            <div class="header">
                <h2>To Do</h2>
            </div>

            <div class="task-container">
                @include('common.errors')

                <!-- Create New Task -->
                <form action="create-task" method="POST" class="add-new-task">
                    @csrf

                    <span class="material-icons">add</span>
                    <input type="text" name="name" id="name" placeholder="Add new task">
                </form>

                <!-- Tasks List -->
                <div class="task-list-container">
                @if (count($tasks) > 0)
                    @foreach ($tasks as $task)
                        <div class="task-list <?php if($task->status=="done") echo "task-done"; ?>" id="task-cont-{{ $task->id }}" >

                            <div class="round">   
                                <form id="update-status-{{$task->id}}" action="/update-status/{{$task->id}}" method="POST">
                                    @csrf  

                                    <input type="checkbox" id="checkbox-{{$task->id}}" name="status" 
                                        <?php if($task->status=="done") echo "checked"; ?>/>
                                    <label for="checkbox-{{ $task->id }}"></label>
                                </form> 
                            </div>

                            <label id="task-name-{{ $task->id }}"  name="name"
                                class="<?php if($task->status=="done") echo "striked" ?>" for="task-status">{{ $task->name }}</label>

                            <a data-toggle="modal" data-target="#editModal-{{$task->id}}" href="#">
                                <span id="edit-button{{$task->id}}" class="material-icons-outlined flex-shrink-1 text-right">edit</span>
                            </a>

                            <a href="/delete/{{$task->id}}">
                                    <span class="material-icons-outlined flex-shrink-1 text-right">delete</span>
                            </a>                              
                        </div>

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('#checkbox-{{ $task->id }}').on('change', function () {
                                    
                                    if($(this).is(":checked")) {
                                        $('#task-name-{{ $task->id }}').addClass("striked");
                                        $('#task-cont-{{ $task->id }}').addClass("task-done");
                                    }
                                    else {
                                        $('#task-name-{{ $task->id }}').removeClass("striked");
                                        $('#task-cont-{{ $task->id }}').removeClass("task-done");
                                    } 
                                    
                                    document.getElementById('update-status-{{$task->id}}').submit();
                                });
                            });

                            $(document).ready(function() {
                                $('#edit-button{{$task->id}}').on('click', function () {
                                    $('#edit-name{{$task->id}}').val("{{$task->name}}");
                                });
                            });
                        </script>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="editModal-{{$task->id}}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title border">Edit</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                    <div class="modal-body">
                                        <label for="name">Task Name:</label>

                                        <form id="edit-name-form-{{$task->id}}" name="edit-name-form" action="update-name/{{$task->id}}" method="POST">
                                            @csrf
                                            <div class="modal-edit">
                                                <input class="edit-input" type="text" name="name" id="edit-name{{$task->id}}" value="{{$task->name}}"></input>       
                                            </div>
                                        </form>
                                    </div>

                                    <div class="modal-footer">
                                
                                        <form action="delete/{{$task->id}}" class="float-left">
                                            <button type="submit" class="btn btn-danger">
                                                <span class="material-icons-outlined">delete</span>      
                                            </button>
                                        </form>

                                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>   

                                        <button type="submit" value="Submit" form="edit-name-form-{{$task->id}}" class="btn btn-primary" method="POST">
                                            Save changes
                                        </button>
    
                                    </div>
                            </div>   
                        </div>
                    </div>           
                    @endforeach
                @endif

                <div class="footer d-flex flex-row">
                    <div class="no-items">
                        {{ count($tasks) }} item/s
                    </div>
                    @if (count($tasks) > 0)
                        <a href="clear-completed" class="text-right">Clear completed</a>   
                    @endif
                </div>   
            </div>

        </div>
        <div class="clear"></div>
    </div>

@endsection