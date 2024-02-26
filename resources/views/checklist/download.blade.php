<!DOCTYPE html>
<html>

<head>

</head>

<body class="bg-gray-600">
    <div class="flex justify-center">
        <div class="w-11/12 flex flex-col bg-white shadow-lg rounded-lg overflow-hidden mt-3">
            <div class="bg-gray-200 text-gray-700 text-lg px-6 py-4">
                <img class="w-10 h-10 m-1 mr-3 float-right rounded-full" src="{{asset('/storage/logo.png')}}" />
                <h5 class="text-lg font-bold text-green-600">Machine Maintainance Report</h5>
                <p class="text-xl text-blue-600 font-bold">Type: {{$machine_name}} {{$type}}</p>
            </div>

            <div class="flex justify-between items-center px-6 py-4">
                <div class="text-sm font-bold">Site: {{$site}}</div>
                <div class="text-sm font-bold">Machine name: {{$machine_name}}</div>
                <div class="text-sm font-bold">Number Plate: {{$number_plate}}</div>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                <div class="border rounded-lg p-4 bg-gray-200">
                    <div class="flex justify-between font-semibold">
                        <span class="w-7/12 ...">Title</span>
                        <span class="w-2/12 ...">Check</span>
                        <span class="w-3/12 ...">Comment</span>
                    </div>
                    @foreach($headers as $list)
                    <div class="flex justify-between text-gray-700 text-sm">
                        <span class="w-7/12">{{$list['item']}}</span>
                        <span class="w-2/12">{{$list['answer']}}</span>
                        <span class="w-3/12">{{$list['comment']}}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-gray-200 px-6 py-4">
                <div class="uppercase text-xs text-gray-600 font-bold">More Details</div>

                <div class="flex">
                    <div class="inline-block mt-1 w-1/2 pr-1">
                        <label class="text-sm font-bold">Prepared by</label>
                        <span>{{$owner}}</span>
                    </div>
                    <div class="inline-block mt-1 w-1/2 pr-1">
                        <label class="text-sm font-bold">Date Prepared</label>
                        <span>{{$date}}</span>
                    </div>
                </div>
                <div class="flex">
                    <div class="inline-block mt-1 w-1/3 pr-1">
                        <label class="text-sm font-bold">Approved by</label>
                        <span>{{$approved_by}}</span>
                    </div>
                    <div class="inline-block mt-1 w-1/3 pr-1">
                        <label class="text-sm font-bold">Date Approved</label>
                        <span>{{$approved_date}}</span>
                    </div>
                    <div class="inline-block mt-1 w-1/3 pr-1">
                        <label class="text-sm font-bold">Comment</label>
                        <span>{{$admincomment}}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>