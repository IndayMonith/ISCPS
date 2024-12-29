CREATE VIEW daily_log_counts AS
SELECT 
    DATE(created_at) AS log_date,
    COUNT(*) AS log_count
FROM 
    logs
GROUP BY 
    DATE(created_at)
ORDER BY 
    log_date;
