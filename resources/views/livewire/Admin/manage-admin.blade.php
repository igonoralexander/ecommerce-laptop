<div>
                            @include('layouts.backend.inc.breadcrumbs')    

                            @if (session()->has('message'))
                                <div class="alert alert-success" style = "font-size: 16px;">{{ session('message') }}</div>
                            @endif
                                
                            <!-- Index View -->
                            @if ($action === 'index')
                                <!-- all-user -->
                                <div class="wg-box">
                                    <div class="flex items-center justify-between gap10 flex-wrap">
                                        <div class="wg-filter flex-grow">
                                            <form class="form-search">
                                                <fieldset class="name">
                                                    <input type="text" placeholder="Search here..." class="" name="name" tabindex="2" value="" aria-required="true" required="">
                                                </fieldset>
                                                <div class="button-submit">
                                                    <button class="" type="submit"><i class="icon-search"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                        <a class="tf-button style-1 w208" href="#" wire:click.prevent="create" ><i class="icon-plus"></i>Add new</a>
                                    </div>
                                    <div class="wg-table table-all-user">
                                        <ul class="table-title flex gap20 mb-14">
                                            <li>
                                                <div class="body-title">Administrators</div>
                                            </li>    
                                            <li>
                                                <div class="body-title">Email</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Action</div>
                                            </li>
                                        </ul>
                                        <ul class="flex flex-column">
                                            @foreach($users as $user)
                                                <li class="wg-product item-row">
                                                    <div class="name flex-grow">
                                                        <div>
                                                            <div class="title">
                                                                <a href="#" class="body-title-2">{{ $user->first_name }} {{ $user->last_name }}</a>
                                                            </div>
                                                            <div class="text-tiny">{{ $user->role }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="body-text">{{ $user->email }}</div>
                                                    <div class="list-icon-function">
                                                        <div class="item eye">
                                                            <a href="#" wire:click.prevent="view({{ $user->id }})" ><i class="icon-eye"></i></a>
                                                        </div>
                                                        <div class="item edit">
                                                            <a  class="item edit" href="#" wire:click.prevent="edit({{ $user->id }})" ><i class="icon-edit-3"></i></a>
                                                        </div>
                                                        <div class="item trash">
                                                            <a class="item trash" href="#" wire:click.prevent="delete({{ $user->id }})" ><i class="icon-trash-2"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="divider"></div>
                                    {{ $users->links('vendor.pagination.tailwind') }}
                                </div>
                                <!-- /all-user -->                                
                            @endif    
                            
                            <!-- Index View -->
                            @if ($action === 'create')
                                <!-- add-new-user -->
                                <form class="form-style-2" method = "POST" wire:submit.prevent="save" >
                                    @csrf

                                    <div class="wg-box">
                                        <div class="left">
                                            <h5 class="mb-4">Account</h5>
                                            <div class="body-text">Fill in the information below to add a new account</div>
                                        </div>
                                        <div class="right flex-grow">
                                            <fieldset class="name mb-24">
                                                <div class="body-title mb-10">First Name</div>
                                                <input class="flex-grow" type="text" placeholder="First Name" wire:model="first_name"  tabindex="0" value="{{old('first_name')}}" aria-required="true" required autofocus>
                                            </fieldset>
                                            <fieldset class="name mb-24">
                                                <div class="body-title mb-10">Last Name</div>
                                                <input class="flex-grow" type="text" placeholder="Last Name" wire:model="last_name"  tabindex="0" value="{{old('last_name')}}" aria-required="true" required>
                                            </fieldset>
                                            <fieldset class="email mb-24">
                                                <div class="body-title mb-10">Email</div>
                                                <input class="flex-grow" type="email" placeholder="Email" wire:model="email"  tabindex="0" value="{{old('email')}}" aria-required="true" required>
                                            </fieldset>
                                            <fieldset class="password mb-24">
                                                <div class="body-title mb-10">Password</div>
                                                <input class="password-input" type="password" placeholder="Enter password" wire:model="password"  tabindex="0" aria-required="true" required autocomplete="new-password">
                                                <span class="show-pass">
                                                    <i class="icon-eye view"></i>
                                                    <i class="icon-eye-off hide"></i>
                                                </span>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="bot">
                                        <button type="submit" class="btn-success tf-button w180">Save</button>
                                        <button type = "button" class="btn-secondary tf-button w180" wire:click="index">Back</button>
                                    </div>

                                </form>
                                <!-- /add-new-user -->
                            @endif

                            <!-- Index View -->
                            @if ($action === 'edit')
                                <!-- add-new-user -->
                                <form class="form-style-2" method = "POST" wire:submit.prevent="update" >
                                    @csrf

                                    <div class="wg-box">
                                        <div class="left">
                                            <h5 class="mb-4">Account</h5>
                                            <div class="body-text">Fill in the information below to add a new account</div>
                                        </div>
                                        <div class="right flex-grow">
                                            <fieldset class="name mb-24">
                                                <div class="body-title mb-10">First Name</div>
                                                <input class="flex-grow" type="text" wire:model="first_name"  tabindex="0" value="{{old('first_name')}}" aria-required="true" required autofocus>
                                            </fieldset>
                                            <fieldset class="name mb-24">
                                                <div class="body-title mb-10">Last Name</div>
                                                <input class="flex-grow" type="text" wire:model="last_name"  tabindex="0" value="{{old('last_name')}}" aria-required="true" required>
                                            </fieldset>
                                            <fieldset class="email mb-24">
                                                <div class="body-title mb-10">Email</div>
                                                <input class="flex-grow" type="email" wire:model="email"  tabindex="0" value="{{old('email')}}" aria-required="true" required>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="bot">
                                        <button type="submit" class="btn-success tf-button w180">Update</button>
                                        <button type = "button" class="btn-secondary tf-button w180" wire:click="index">Back</button>
                                    </div>

                                </form>
                                <!-- /add-new-user -->
                            @endif
                            @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            $(document).on("click", ".show-pass", function () {
                $(this).toggleClass("active");
                var input = $(this).closest(".password").find(".password-input");

                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        });
    </script>
@endpush

</div>
