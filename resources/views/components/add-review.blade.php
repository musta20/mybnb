<form method="post" action="{{ route('AddReview') }}" class="p-2 m-2 space-x-2">
    @csrf
    <label for="message" class="block mb-2 text-sm  font-medium text-gray-900 dark:text-white">
        {{ __('messages.add review') }}
    </label>
    <x-add-rating />
    <textarea id="comment" rows="4" name="comment"
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50  border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder=""></textarea>
    <button type="submit" class="text-white m-2  bg-slate-900
    rounded-lg
    hover:bg-slate-800 focus:outline-none focus:ring-4
    focus:ring-green-300 font-medium  text-sm px-5 py-2.5 text-center me-2 mb-2
     ">{{ __('messages.publish') }}</button>
    <input value="{{ $listing->id }}" name="listing_id" hidden />
</form>