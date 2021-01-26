<!-- below we're using the built in php count method to loop through all the data sent with the dollar sign errors variable -->
<!-- The errors variable is something that is automatically created when we use the withErrors function/method in Laravel, and we can use it to access the errors that were caught -->
<!-- On our dollar sign errors variable, we're using the all method to get all methods (errors?) -->
<!-- All this if statement does is basically check to see if there anything in the errors variable - if the count is greater than 0 -->
@if(count($errors))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger">
            <ul>
                <!-- Here is where we're outputting our errors -->
                <!-- To do so, we're using the foreach method to loop through each of the errors in the dollar sign error variable, getting the data using the all method -->
                <!-- As we're looping through all the errors, we're storing the error in a local variable called dollar sign error, and then outputting that error instance as a list element -->
                <!-- the cool thing is, Laravel comes with some predefined/prewritten error messages, so we don't have to write our own -->
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif