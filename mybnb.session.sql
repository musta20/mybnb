SELECT * FROM listings 
 LEFT JOIN bookings ON listings.id = bookings.listing_id
WHERE bookings.check_out_date <= '2024-05-28'
AND listings.city = 'Suez' 
 
AND listings.number_of_bedrooms >= 4
