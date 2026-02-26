library(readxl)
library(ggplot2)

# Read in data from xlsx file
data_df <- read_excel("C:\\Users\\Chiara\\OneDrive - Università di Napoli Federico II\\Desktop\\VIS\\Final project\\data.xlsx")

# Extract month from datetime column
data_df$month <- month(data_df$datetime)

# Plot energy consumption over time
plot_1 <- ggplot(data = data_df, aes(x = datetime)) +
          geom_line(aes(y = load), linewidth = 0.7, color = "#FA1D40") +
          labs(x = "Month", y = "Energy Consumption (kW)", title = "Energy Consumption during 2013") +
          scale_x_datetime(date_breaks = "1 month", date_labels = "%b %Y") +
          theme_minimal() +
          theme(text = element_text(size = 17)) 

# Save the plot as a PDF with specific size and resolution
ggsave("energy_consumption_2013.pdf", width = unit(20, "cm"), height = unit(10, "cm"))

          

# Plot energy production and consumption over time
plot_2 <- ggplot(data = data_df, aes(x = datetime)) +
          geom_line(aes(y = production), linewidth = 0.7, color = "#85D917") +
          labs(x = "Month", y = "Energy Production(kW)", title = "Energy Production during 2013") +
          scale_x_datetime(date_breaks = "1 month", date_labels = "%b %Y") +
          theme_minimal() +
          theme(text = element_text(size = 17)) 

# Save the plot as a PDF with specific size and resolution
ggsave("energy_production_2013.pdf", width = unit(20, "cm"), height = unit(10, "cm"))