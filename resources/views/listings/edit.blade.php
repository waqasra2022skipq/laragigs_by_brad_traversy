<x-layout>
    @php
    $selectedCats = [];
    foreach ($listing->categories as $key => $cat) {
        array_push($selectedCats, $cat->id);
    }
    @endphp
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
        
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit {{$listing->title}}
            </h2>
            <p class="mb-4">Post a gig to find a developer</p>
        </header>

        <form method="POST" action="/listings/{{$listing->id}}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="mb-6">
                <label
                    for="company"
                    class="inline-block text-lg mb-2"
                    >Company Name</label
                >
                <input
                    value=" {{ $listing->company }} "
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="company"
                />
                @error('company')
                <p class="text-red-500 text-xs mt-1"> {{$message}} </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2"
                    >Job Title</label
                >
                <input
                    type="text"
                    value=" {{ $listing->title }} "

                    class="border border-gray-200 rounded p-2 w-full"
                    name="title"
                    placeholder="Example: Senior Laravel Developer"
                />
                @error('title')
                <p class="text-red-500 text-xs mt-1"> {{$message}} </p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="location"
                    class="inline-block text-lg mb-2"
                    >Job Location</label
                >
                <input
                    type="text"
                    value=" {{ $listing->location }} "

                    class="border border-gray-200 rounded p-2 w-full"
                    name="location"
                    placeholder="Example: Remote, Boston MA, etc"
                />
                @error('location')
                <p class="text-red-500 text-xs mt-1"> {{$message}} </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2"
                    >Contact Email</label
                >
                <input
                    type="text"
                    value=" {{ $listing->email }} "

                    class="border border-gray-200 rounded p-2 w-full"
                    name="email"
                />
                @error('email')
                <p class="text-red-500 text-xs mt-1"> {{$message}} </p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="website"
                    class="inline-block text-lg mb-2"
                >
                    Website/Application URL
                </label>
                <input
                    value="{{ $listing->website }}" 
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="website"
                />
                @error('website')
                <p class="text-red-500 text-xs mt-1"> {{$message}} </p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="expires"
                    class="inline-block text-lg mb-2"
                >
                    Last Date
                </label>
                <input 
                    value="{{ $listing->expires }}"
                    type="date"
                    min="{{date("Y-m-d")}}"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="expires"
                />
                @error('expires')
                <p class="text-red-500 text-xs mt-1"> {{$message}} </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="categories" class="inline-block text-lg mb-2">
                    Select Categories
                </label>
                <br>
                <select name="categories[]" multiple>
                    @foreach($categories as $cat)
                        <option value="{{$cat->id}}" {{ in_array($cat->id, $selectedCats) ? "selected": "" }}>{{$cat->name}}</option>
                    @endforeach
                </select>
                @error('categories')
                <p class="text-red-500 text-xs mt-1"> {{$message}} </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                    Company Logo
                </label>
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="logo"
                    value="{{ $listing->logo }}"
                />
                <img class="mr-6 mb-6 w-48" alt="test" src="{{ $listing->logo ? asset("storage/" . $listing->logo) : asset('storage/no-image.png') }}" alt="">
                @error('logo')
                <p class="text-red-500 text-xs mt-1"> {{$message}} </p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="content"
                    class="inline-block text-lg mb-2"
                >
                    Job Description
                </label>
                <textarea
                
                    class="border border-gray-200 rounded p-2 w-full"
                    name="content"
                    rows="10"
                    placeholder="Include tasks, requirements, salary, etc"
                >{{$listing->content}}</textarea>
                @error('content')
                <p class="text-red-500 text-xs mt-1"> {{$message}} </p>
                @enderror
            </div>

            <div class="mb-6">
                <button
                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                >
                    Update Gig
                </button>

                <a href="/" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>