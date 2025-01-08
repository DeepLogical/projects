<div>
    @livewire('adminSearch', ['page' => 'Admin Product', 'routeName' => 'addUpdateProduct', 'link' => '', 'routeText' => 'Add Product'])
    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>#</th>
                <th>Product // Image</th>
                <th>Manufacturer</th>
                <th>Functions</th>
                <th>TDS</th>
                <th>end</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead> 
        <tbody>
            @foreach($data as $i)
                <tr wire:key="data-{{ $loop->index }}">
                    <td>{{ $loop->index +1 }}</td>
                    <td>
                        <a href="/{{ $i->url }}" target="_blank">
                            <img src="/storage/product/{{ optional($i->media)->media}}" class="w-32" loading="lazy">
                            {{ $i->name }}
                        </a>
                    </td>
                    <td>
                        <strong>Category</strong>: 
                        @foreach($i->category as $j)
                            <a href="/{{ $j->type }}/{{ $j->url }}" target="_blank" wire:key="category-{{ $loop->index }}">{{ $j->name }}, </a>
                        @endforeach<br/>
                        <strong>Tag</strong>: 
                        @foreach($i->tag as $j)
                            <a href="/{{ $j->type }}/{{ $j->url }}" target="_blank" wire:key="tag-{{ $loop->index }}">{{ $j->name }}, </a>
                        @endforeach
                    </td>
                    <td>
                        @if($i->meta)
                            <span class="{{ strlen( $i->meta->title ) < 50 || strlen( $i->meta->title ) > 60 ? 'bg-action text-white px-1 py-1' : '' }}">Title: {{ $i->meta->title }} - {{ strlen( $i->meta->title ) }}</span><br/>
                            <span class="{{ strlen( $i->meta->description ) < 140 || strlen( $i->meta->description ) > 160 ? 'bg-action text-white px-1 py-1' : '' }}">Description: {{ $i->meta->description}} -  {{ strlen( $i->meta->description ) }}</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($i->updated_at)->isoFormat('Do MMM YYYY') }}</td>
                    <td>
                        <div class="flex items-center">
                            <div class="threeDots">
                                <img src="/images/icons/static/action.svg">
                                <div class="dotOptions" style="display:none">
                                    <a href="{{ route('addUpdateProduct', ['id' => encode($i->id)] ) }}">Edit</a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($data)<div class="paginate">{{ $data->links() }}</div>@endif
    
</div>