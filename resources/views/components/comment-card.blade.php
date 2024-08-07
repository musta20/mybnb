@props([ 'review' ])
<div class="mb-1 py-3 ">
  <div class="py-1 mb-2 border-b-2 flex w-full md:w-1/2 gap-3 justify-between ">
   <strong>{{ $review->guest->name }}</strong>
   <x-user-rating :showText="false" :rating="$review->rating" />
      <hr>

</div>
   <p>
    {{ $review->comment }}
   </p>
</div>