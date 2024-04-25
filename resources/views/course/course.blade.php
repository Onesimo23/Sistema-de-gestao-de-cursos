@extends('main')

@section('content')
<!-- content -->
<div class="page-content">
    <div class="page-content-inner">


        <nav id="breadcrumbs" class="mb-3">
            <ul>
                <li><a href="#"> <i class="uil-home-alt"></i> </a></li>
                <li> Cursos </li>

            </ul>
        </nav>

        <div class="d-flex justify-content-between mb-3">
            <h3> Courses (1) </h3>

            <div>
                <button class="uk-button uk-button-default uk-margin-small-right" type="button" uk-toggle="target: #modal-example">
                    <i class="uil-plus"> </i>Novo curso
                </button>
            </div>
        </div>

        <div class="uk-child-width-1-3@m" uk-grid="" uk-scrollspy="cls: uk-animation-slide-bottom-small; target: > div ; delay: 200">
            @foreach ($course as $value )
            <div>
                <a href="#">
                    <div class="card animate-this uk-inline-clip">
                        <img src="{{asset('assets\images\course\2.png')}}" alt="">
                        <div class="card-body text-center pb-3">
                            <h6 class=" mb-0"> {{ $value->name }} </h6>
                        </div>
                        <div class="card-footer py-0 border-top-0">
                            <div class="row align-items-center text-center">
                                <div class="col-6 py-3">
                                    <a href="#" class="text-muted"> Editar</a>
                                </div>
                                <div class="col-6 py-3">
                                    <button class="btn btn-outline-primary" type="button" uk-toggle="target: #modal-examp" data-course="{{ $value->name }}" data-price="{{ $value->price }}">Pagar</button>
                                    {{-- <button class="btn btn-outline-primary" type="button" uk-toggle="target: #modal-examp" data-course="{{ $value->name }}" data-price="{{ $value->price }}">Pagar</button> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <!-- This is the modal1 -->
        <div id="modal-examp" uk-modal="">
            <div class="uk-modal-dialog uk-modal-body">
                <h2 class="uk-modal-title">Complete a sua inscrição</h2>
                <form method="POST" action="{{ route('payments.store') }}">
                    @csrf
                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label" for="user_id">Nome do usuário</label>
                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-feather-user"></i>
                                </span>
                                <select class="selectpicker" value="user_id" name="user_id">
                                    @foreach ($user as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label" for="course_id">Curso</label>
                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-feather-mail"></i>
                                </span>
                                <select class="selectpicker" value="course_id" name="course_id">
                                    @foreach ($course as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label" for="">Valor</label>
                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-feather-mail"></i>
                                </span>
                                <select class="selectpicker" value="course_id" name="">
                                    @foreach ($course as $value)
                                    <option value="{{$value->id}}">{{$value->price}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <select class="uk-select" id="statusSelect" name="status">
                            <option value="">Selecione</option>
                            <option value="pending">Pendente</option>
                            <option value="paid">Concluído</option>
                        </select>
                    </div>
                    <p class="uk-text-right">
                        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                        <button class="uk-button uk-button-primary" type="submit">Save</button>
                    </p>
                </form>
            </div>
        </div>

<!-- End This is the modal1 -->

<script>
    // Adicione um evento de clique para cada botão "Pagar"
    document.querySelectorAll('.btn-outline-primary').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            var cursoNome = this.getAttribute('data-course');
            var cursoValor = this.getAttribute('data-price');
            document.getElementById('course_id').value = cursoNome;
            document.getElementById('price').value = cursoValor;
            UIkit.modal('#modal-examp').show();
        });
    });
</script>


        <ul class="uk-pagination my-5 uk-flex-center" uk-margin="">
            <li class="uk-active"><span>1</span></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li class="uk-disabled"><span>...</span></li>
            <li><a href="#"><span uk-pagination-next=""></span></a></li>
        </ul>

        <!-- This is the modal -->
        <div id="modal-example" uk-modal="">
            <div class="uk-modal-dialog uk-modal-body">
                <h2 class="uk-modal-title">Novo Curso</h2>
                <form id="user-form" method="POST" action="{{route('course.store')}}">
                    @csrf
                    <div class="card">
                        <div class="card-header border-bottom-0 py-4">
                            <h5> Configuração dos Cursos </h5>
                        </div>


                        <ul class="uk-child-width-expand uk-tab" uk-switcher="connect: #course-edit-tab ; animation: uk-animation-slide-left-medium, uk-animation-slide-right-medium">
                            <li class="uk-active"><a href="#"> Curso</a></li>
                            <li><a href="#">Módulos</a></li>
                            <li><a href="#"> Aulas</a></li>
                            <li><a href="#">Finalizar</a></li>
                        </ul>

                        <div class="card-body">

                            <ul class="uk-switcher uk-margin" id="course-edit-tab">

                                <li>

                                    <div class="row">
                                        <div class="col-xl-9 m-auto">


                                            <div class="form-group row mb-3">
                                                <label class="col-md-3 col-form-label" for="course_title">Nome do Curso<span class="required">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Digita o título do curso" value="" required="">
                                                    <input type="hidden" id="course_name" name="course_name" value="">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label class="col-md-3 col-form-label" for="short_description">Descrição</label>
                                                <div class="col-md-9">
                                                    <textarea name="description" id="description" class="form-control" placeholder="..."></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label class="col-md-3 col-form-label" for="course_title"> Estado do Curso <span class="required">*</span></label>
                                                <div class="col-md-9">

                                                    <select class="selectpicker" name="role" id="role">
                                                        <option value="free"> Grátis </option>
                                                        <option value="paid"> Pago </option>
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label class="col-md-3 col-form-label" for="course_title"> Em destaque <span class="required">*</span></label>
                                                <div class="col-md-9">

                                                    <select class="selectpicker" name="highlighted" id="highlighted">
                                                        <option value="true">Sim</option>
                                                        <option value="false"> Não </option>
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label class="col-md-3 col-form-label">Preço ($)</label>
                                                <div class="col-md-9">
                                                    <input type="number" name="price" id="price" class="form-control" placeholder="Digite o preço">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label class="col-md-3 col-form-label" for="course_title"> Validade<span class="required">*</span></label>
                                                <div class="col-md-9">

                                                    <select class="selectpicker" name="validate" id="validate">
                                                        <option value="lifetime"> Vitalício </option>
                                                        <option value="one_year"> 1 ano</option>
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label class="col-md-3 col-form-label" for="user_id"> Instrutor <span class="required">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="selectpicker" value="user_id" name="user_id">
                                                        @foreach ($user as $value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="uk-width-2-5@m uk-flex-last@m">

                                                <div class="uk-card-default rounded text-center p-4">
                                                    <div class="uk-position-relative my-4">

                                                        <div class="user-profile-photo  m-auto">
                                                            <img id="profileImage" src="" alt="">
                                                        </div>



                                                        <div class="uk-position-center">
                                                            <div uk-form-custom="">
                                                                <input type="file" id="imageInput" name="picture">
                                                                <span class="uk-link icon-feather-camera icon-medium text-black"> </span>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </li>


                                <li>

                                    <div class="row justify-content-center">
                                        <div class="col-xl-9">
                                            <div class="form-group row mb-3">
                                                <label class="col-md-3 col-form-label" for="website_keywords">Nome do módulo</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="modulename" name="modulename" style="width: 100%;">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>

                                {{-- Lesson wizard --}}

                                <li>
                                    <div class="row justify-content-center">
                                        <div class="col-xl-9">
                                            <input type="hidden" id="modulo_name" name="module_id" value="">

                                            <div class="form-group row mb-3">
                                                <label class="col-md-3 col-form-label" for="website_keywords">Titulo</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="title_lesson" name="title_lesson" placeholder="Título da aula">
                                                    <div class="bootstrap-tagsinput"><input size="1" type="text" placeholder="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label class="col-md-3 col-form-label" for="short_description">Descrição</label>
                                                <div class="col-md-9">
                                                    <textarea name="description" id="description" class="form-control" placeholder="..."></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label class="col-md-3 col-form-label" for="website_keywords">Nr da aula</label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" id="lesson_number" name="lesson_number" style="width: 100%;">
                                                    <div class="bootstrap-tagsinput"><input size="1" type="text" placeholder="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label class="col-md-3 col-form-label" for="website_keywords">Plataforma</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control bootstrap-tag-input" id="platform_name" name="platform_name"  style="width: 100%;">
                                                    <div class="bootstrap-tagsinput"><input size="1" type="text" placeholder="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label class="col-md-3 col-form-label" for="website_keywords">Link da aula</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control bootstrap-tag-input" id="video_link" name="video_link" data-role="tagsinput" style="width: 100%; ">
                                                    <div class="bootstrap-tagsinput"><input size="1" type="text" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li>

                                    <div class="row">
                                        <div class="col-12 my-lg-5">
                                            <div class="text-center">
                                                <h2 class="mt-0"><i class="icon-feather-check-circle text-success"></i></h2>
                                                <h3 class="mt-0">Obrigado !</h3>

                                                <p class="w-75 mb-2 mx-auto"> Submeta se estiver de acordo. </p>

                                                <div class="mb-3 mt-3">
                                                    <button type="submit" class="btn btn-default">Salvar</button>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>


                                </li>

                            </ul>

                        </div>

                    </div>
                </form>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                </p>
            </div>
        </div>
        @endsection()
        <script>
             document.querySelector('form').addEventListener('submit', function(event) {
                var courseName = document.getElementById('fname').value;
                document.getElementById('course_name').value = courseName;
            });
        </script>

<script>
    document.getElementById('user-form').addEventListener('submit', function(event) {
       var moduleName = document.getElementById('modulename').value;
       document.getElementById('modulo_name').value = moduleName;
   });
</script>

