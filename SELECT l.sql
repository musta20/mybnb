SELECT l.*
FROM listings l
WHERE l.city = 'Suez'
AND l.number_of_bedrooms >= 4
AND
 NOT EXISTS (
    SELECT 1
    FROM bookings b
    WHERE b.listing_id = l.ids
    AND b.status IN ('active', 'pending') -- Consider relevant booking statuses
    AND '2024-05-29' = b.check_out_date
);
