SET GLOBAL event_scheduler = ON;
CREATE EVENT update_poster_status
ON SCHEDULE EVERY 1 MINUTE -- Kiểm tra mỗi phút
DO
  UPDATE poster 
  SET status = 
    CASE 
      WHEN start_date > CURDATE() THEN 'Coming'
      WHEN start_date <= CURDATE() AND expiration_date >= CURDATE() THEN 'Showing'
      ELSE 'Ended'
    END;


