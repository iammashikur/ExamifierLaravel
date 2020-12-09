<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.5.2/materia/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Create Exam</title>


</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Mediexams</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

            <div class="collapse navbar-collapse" id="navbarColor03">
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Exam Rules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Punishment</a>
                    </li>

                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-3 mt-4">

                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-pencil-ruler"></i> Exams</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-clock"></i> Results</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-exclamation-triangle"></i> Notice</a>
                    <a href="student-login.html" class="list-group-item list-group-item-action"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>

            </div>


            <div class="col-md-9 mt-4">
                <form action="{{url('/examiner/exam')}}" method="POST" class="Mediexams-form">

                <div class="exam-create">

                    <h2 class="text-center mb-4">Create Exam</h2>

                        @csrf
                        <div class="row">


                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Exam Name</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1">
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Subject</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1">
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Chapter/Topic</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1">
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Time</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1">
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <p class="btn btn-danger" onclick="addMcq()"> <i class="fas fa-plus    "></i> Add MCQ</p>
                                <p class="btn btn-danger" onclick="trueFalse()"> <i class="fas fa-plus    "></i> Add True/False</p>
                            </div>







                        </div>



                </div>

                <div class="row">


                    <div class="col-md-12 col-12 mb-4 mt-4" id="mcq">

                        @for ($i = 1; $i < 10; $i++)


                        <div class="mcq-box border p-4  mb-4">

                            <div class="row">

                                <div class="col-12 mb-2">


                                    <label for="exampleFormControlInput1">McQ Here.</label>
                                    <textarea name="McQ_{{$i}}" type="email" class="custom-textarea w-100 mt-2" rows="10" id="exampleFormControlInput1"></textarea>

                                </div>

                                @for ($o = 1; $o < 5; $o++)

                                <div class="col-6 mb-2">

                                    <div class="custom-control custom-radio">
                                    <input type="radio" id="Question_{{$i}}Radio_{{$o}}" name="Question_{{$i}}" class="custom-control-input">
                                        <label class="custom-control-label w-100" for="Question_{{$i}}Radio_{{$o}}">
                                           <textarea name="Question_{{$i}}Choice_{{$o}}" class="w-100 custom-textarea" name="" id=""  rows="3"></textarea>
                                        </label>
                                    </div>
                                </div>

                                @endfor



                                <div class="col-12 mb-2 mt-4">

                                    <p class="btn btn-success btn-sm" onclick="addMcq()"> <i class="fas fa-copy    "></i> Copy</p>
                                    <p class="btn btn-primary btn-sm"> <i class="fas fa-paste    "></i> Paste</p>

                                </div>


                            </div>

                        </div>
                    @endfor






                    </div>

                    <div class="col-md-12 col-12 mb-4 mt-4" id="true-false" style="display: none;">

                        <div class="mcq-box border p-4">

                            <div class="row">

                                <div class="col-12 mb-2">


                                    <label for="exampleFormControlInput1">True False Question Here.</label>
                                    <textarea type="email" class="custom-textarea w-100 mt-2" rows="10" id="exampleFormControlInput1"></textarea>

                                </div>

                                <div class="col-12 mb-2">

                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label w-100" for="customRadio1">
                                           <textarea class="w-100 custom-textarea" name="" id=""  rows="3"></textarea>
                                        </label>
                                    </div>
                                </div>


                                <div class="col-12 mb-2">

                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label w-100" for="customRadio1">
                                           <textarea class="w-100 custom-textarea" name="" id=""  rows="3"></textarea>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 mb-2">

                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label w-100" for="customRadio1">
                                           <textarea class="w-100 custom-textarea" name="" id=""  rows="3"></textarea>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 mb-2">

                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label w-100" for="customRadio1">
                                           <textarea class="w-100 custom-textarea" name="" id=""  rows="3"></textarea>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 mb-2">

                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label w-100" for="customRadio1">
                                           <textarea class="w-100 custom-textarea" name="" id=""  rows="3"></textarea>
                                        </label>
                                    </div>
                                </div>







                                <div class="col-12 mb-2 mt-4">

                                    <p class="btn btn-success btn-sm" onclick="addMcq()"> <i class="fas fa-copy    "></i> Copy</p>
                                    <p class="btn btn-primary btn-sm"> <i class="fas fa-paste    "></i> Paste</p>

                                </div>


                            </div>

                        </div>



                    </div>



                </div>


                <button type="submit">Submit</button>



            </form>
            </div>

        </div>
    </div>












<section class="content">
    <h1 class="content__heading">Send Me a Message</h1>
    <p class="content__lede">Use this handy contact form to get in touch with me.</p>
    <form class="content__form contact-form">
      <div class="testing">
        <p>Does this do anything?</p>
      </div>
      <div class="contact-form__input-group">
        <input class="contact-form__input contact-form__input--radio" id="salutation-mr" name="salutation" type="radio" value="Mr."/>
        <label class="contact-form__label contact-form__label--radio" for="salutation-mr">Mr.</label>
        <input class="contact-form__input contact-form__input--radio" id="salutation-mrs" name="salutation" type="radio" value="Mrs."/>
        <label class="contact-form__label contact-form__label--radio" for="salutation-mrs">Mrs.</label>
        <input class="contact-form__input contact-form__input--radio" id="salutation-ms" name="salutation" type="radio" value="Ms."/>
        <label class="contact-form__label contact-form__label--radio" for="salutation-ms">Ms.</label>
      </div>
      <div class="contact-form__input-group">
        <label class="contact-form__label" for="name">Full Name</label>
        <input class="contact-form__input contact-form__input--text" id="name" name="name" type="text"/>
      </div>
      <div class="contact-form__input-group">
        <label class="contact-form__label" for="email">Email Address</label>
        <input class="contact-form__input contact-form__input--email" id="email" name="email" type="email"/>
      </div>
      <div class="contact-form__input-group">
        <label class="contact-form__label" for="subject">How can I help you?</label>
        <select class="contact-form__input contact-form__input--select" id="subject" name="subject">
          <option>I have a problem.</option>
          <option>I have a general question.</option>
        </select>
      </div>
      <div class="contact-form__input-group">
        <label class="contact-form__label" for="message">Enter a Message</label>
        <textarea class="contact-form__input contact-form__input--textarea" id="message" name="message" rows="6" cols="65"></textarea>
      </div>
      <div class="contact-form__input-group">
        <p class="contact-form__label--checkbox-group">Please send me:</p>
        <input class="contact-form__input contact-form__input--checkbox" id="snacks-pizza" name="snacks" type="checkbox" value="pizza"/>
        <label class="contact-form__label contact-form__label--checkbox" for="snacks-pizza">Pizza</label>
        <input class="contact-form__input contact-form__input--checkbox" id="snacks-cake" name="snacks" type="checkbox" value="cake"/>
        <label class="contact-form__label contact-form__label--checkbox" for="snacks-cake">Cake</label>
      </div>
      <input name="secret" type="hidden" value="1b3a9374-1a8e-434e-90ab-21aa7b9b80e7"/>
      <button class="contact-form__button" type="submit">Send It!</button>
    </form>
  </section>
  <div class="results">
    <h2 class="results__heading">Form Data</h2>
    <pre class="results__display-wrapper"><code class="results__display"></code></pre>
  </div>

    <script>
        function addMcq() {
            $("#mcq").show();
        }

        function trueFalse() {
            $("#true-false").show();
        }
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
