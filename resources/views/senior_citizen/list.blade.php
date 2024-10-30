@include('partials.header')
@php $array = array('title' => 'SPENDS') @endphp
<x-nav :data="$array"/>
<header class="max-w-lg mx-auto mt-5">
    <a href="#">
        <h1 class="text-4xl font-bold text-white text-center">Senior List</h1>
    </a>
</header>
<section class="mt-10">
    <div class="overflow-x-auto relative">
        <table class="w-96 mx-auto text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        
                    </th>
                    <th scope="col" class="py-3 px-6">
                        First Name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Last Name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Email
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Age
                    </th>
                    <th scope="col">

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($seniors as $senior)
                <tr class="bg-gray-800 border-b text-white">
                    @php
                    $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$senior->first_name."-".$senior->last_name;
                    @endphp
                    <td>
                        <img src="{{ $senior->profile_picture ? asset("storage/senior/thumbnail/".$senior->profile_picture) : $default_profile }}">
                    </td>
                    <td class="py-4 px-6">
                        {{ $senior->first_name }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $senior->last_name }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $senior->email }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $senior->age }}
                    </td>
                    <td class="py-4 px-6">
                        <a href="/senior/{{$senior->id}}" class="bg-sky-600 text-white px-4 py-1 rounded">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mx-auto max-w-lg pt-6 p-4">
            {{$seniors->links()}}
        </div>
    </div>
</section>
@include('partials.footer')