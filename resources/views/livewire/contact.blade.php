<div>
       <!--page-content-->
       <div class="page-content">
        <div class="container">
            @session('message')
            <div class="row">
                <div class="alert alert-success col-12">{{$value}}</div>
            </div>
            @endsession
            <div class="contact-form">
                <h2>تواصل معنا</h2>
                <form action="{{route('contact.add')}}" method="POST" enctype="multipart/form-data" >
                    @csrf

                    @method("POST")

                    <div class="form-group">
                        <input type="text" class="form-control" wire:model.live='name' placeholder="الإسم كاملا" name="name" required>
                        @error('name')
                        <span class="help-block text-right text-light">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model.live='title' placeholder="العنوان" name="title" required>
                        @error('title')
                        <span class="help-block text-right text-light">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" wire:model.live='email'  placeholder="البريد الإلكترونى" name="email" required>
                        @error('email')
                        <span class="help-block text-right text-light">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea name="description"  wire:model.live='description' placeholder="ماهى رسالتك؟"></textarea>
                        @error('description')
                        <span class="help-block text-right text-light">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="issue-type row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="contact-type1" value="{{$suggestion->value}}" checked>
                                <label class="form-check-label" for="contact-type">{{$suggestion->name()}}</label>
                            </div>
                        </div>
                         <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="contact-type2" value="{{$complaint->value}}">
                                <label class="form-check-label" for="contact-type">{{$complaint->name()}}</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="contact-type3" value="{{$replay->value}}">
                                <label class="form-check-label" for="contact-type">{{$replay->name()}}</label>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="احفظ التعديلات" class="submit">
                </form>
            </div>
        </div>
    </div>
</div>
