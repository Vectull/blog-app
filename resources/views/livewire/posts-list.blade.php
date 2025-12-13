<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach ($posts as $post)
        <div class="col">
            <livewire:post-card :post="$post" :key="$post->id" />
        </div>
    @endforeach
</div>