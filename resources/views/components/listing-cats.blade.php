@props(['catsCSV'])

<ul class="flex">
    @foreach($catsCSV as $cat)
    <li
        class="bg-black text-white rounded-xl px-3 py-1 mr-2"
    >
        <a href="/listings/categories/{{$cat->id}}"> {{$cat->name}} </a>
    </li>
    @endforeach

</ul>