<div class="p-10 bg-white rounded shadow-xl">
    <div>
        @if (session()->has('message'))
        <div class="p-3 bg-green-300 text-green-800 rounded shadow-sm">
            {{ session('message') }}
        </div>
        @elseif(session()->has('error'))
        <div class="alert alert-danger">{{session()->get('error')}}</div>
        @endif
    </div>
    <p class="text-lg text-gray-800 font-medium pb-1">Add Machine</p>
    <div class="flex">
        <div class="inline-block mt-1 w-1/3 pr-1">
            <label class="text-sm font-bold text-gray-600">Machine Name</label>
            <select class="form-control rounded" id="sel" wire:model.defer="machine_name">
                <option value="">Select Machine</option>
                <option value="Bulldozer">Bulldozer</option>
                <option value="Tractor">Tractor</option>
                <option value="Motorbike">Motorbike</option>
                <option value="Mower">Mower</option>
                <option value="Auger">Auger</option>
                <option value="Trailer">Trailer</option>
                <option value="Waterbowser">Water bowser</option>
                <option value="Waterpump(petrol)">Waterpump (petrol)</option>
                <option value="Waterpump(diesel)">Waterpump (diesel)</option>
                <option value="Chainsaw">Chainsaw</option>
                <option value="Compressor">Compressor</option>
                <option value="Donkeycart">Donkey cart</option>
                <option value="Truck">Truck</option>
                <option value="Pickup">Pick Up</option>
                <option value="Fielder">Fielder</option>
                <option value="Landcruiser">Landcruiser</option>
                <option value="Brush Cutters">Brush Cutters</option>
                <option value="Slashers">Slashers</option>
                <option value="Welding Machine">Welding Machine</option>
                <option value="Power Saw1">Power Saw1</option>
                <option value="Power Saw2">Power Saw2</option>
                <option value="Drill">Drill</option>
                <option value="House Keeping">House Keeping</option>
                <option value="Nursery Fencing">Nursery Fencing</option>
                <option value="Electric Fence">Electric Fence</option>
                <option value="Notice Board">Notice Board</option>
                <option value="Tools and Maintainance">Tools and Maintainance</option>
                <option value="Gate">Gate</option>
                <option value="Honda Brush Cutters">Honda Brush Cutters</option>
                <option value="Solar">Solar</option>
                <option value="Generator">Generator</option>
                <option value="Engine Boat">Engine Boat</option>
                <option value="Drinking Water Tank">Drinking Water Tank</option>
            </select>
            @error('machine_name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
       <div class="inline-block mt-1 w-1/3 pr-1">
            <label class="text-sm font-bold text-gray-600">Add Dropdown Option</label>
            <input class="form-control rounded"  type="text" name='option' id='option' placeholder="add drop down Option">
        </div>
        <div class="inline-block mt-1 w-1/3 pr-1 pt-9">
            <button id='btnAdd' class="px-2 py-1 btn-sm text-white font-light tracking-wider bg-blue-900 rounded">Add</button>
        </div>
    </div>

    <div class="flex mt-2">
         <div class="inline-block mt-1 w-1/3 pr-1">
            <label class="text-sm font-bold text-gray-600">Number Plate</label>
            <input class="form-control rounded" wire:model.defer="number_plate" type="text" required="" placeholder="number plate">
            @error('number_plate') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="inline-block mt-1 w-1/3 pr-1">
            <label class="text-sm font-bold text-gray-600" for="cus_email">Model Number</label>
            <input class="form-control rounded" wire:model.defer="model_number" type="text" required="" placeholder="model number">
            @error('model_number') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="inline-block mt-1 w-1/3 pr-1">
            <label class="text-sm font-bold text-gray-600">Worked Hours/KM</label>
            <input class="form-control rounded" wire:model.defer="worked_hours" type="number" required="" placeholder="Worked hours/KM">
            @error('worked_hours') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
  </div>
    <div class="flex mt-2">
        <div class="inline-block mt-1 w-1/3 pr-1">
            <label class="text-sm font-bold text-gray-600">Upcoming Plan</label>
            <input class="form-control rounded" wire:model.defer="plan" type="text" required="" placeholder="Upcoming Plan">
            @error('plan') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="inline-block mt-1 w-1/3 pr-1">
            <label class="text-sm font-bold text-gray-600" for="cus_email">Hours Remaining to Plan</label>
            <input class="form-control rounded" wire:model.defer="plan_hours" type="text" required="" placeholder="Hours Remaining to Plan">
            @error('plan_hours') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="inline-block mt-1 w-1/3 pr-1">
            <label class="text-sm font-bold text-gray-600" for="cus_email">Site</label>
            <select class="form-control rounded" wire:model.defer="site">
                <option value="">Select Site</option>
                <option value="Head Office">Head Office</option>
                <option value="Kiambere">Kiambere</option>
                <option value="Nyongoro">Nyongoro</option>
                <option value="Dokolo">Dokolo</option>
                <option value="7 Forks">7 Forks</option>
                <option value="GIC">GIC</option>
            </select>
            @error('site') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <button wire:click.prevent="addMachine" wire:loading.class="hidden" class="px-4 py-1 text-white font-light tracking-wider bg-green-900 rounded">Submit</button>
    </div>
   @push('scripts')
      <script>
        var btn = document.getElementById('btnAdd');
          btn.onclick = function(){
              var tb = document.getElementById('option'), val = tb.value;
              if(val.length){
                  var sel = document.getElementById('sel');
                  var opt = document.createElement('option');
                  opt.value = val;
                  opt.innerHTML = val;
                  sel.appendChild(opt);
                  tb.value = '';
              }
          };
      </script>
   @endpush
</div>