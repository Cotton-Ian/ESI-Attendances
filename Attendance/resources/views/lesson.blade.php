@extends('canevas')
@section('title', 'Lesson')
@section('content')
<div>
    <table class="mx-auto text-sm text-left text-gray-500 dark:text-gray-400" id="student-table">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">Title</th>
                <th scope="col" class="py-3 px-6">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lessons as $lesson)
                <tr class=" bg-white border-b dark:bg-gray-800 dark:border-gray-700 ">
                    <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a class="underline" href='{{ route("lessons.presence", ["id" => $lesson -> id]) }}'>
                            {{ $lesson -> title }}
                        </a>
                    </td>
                    <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $lesson -> date }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection