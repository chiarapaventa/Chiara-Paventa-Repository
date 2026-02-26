library(ggplot2)
library(readxl)
library(dplyr)
library(lubridate)

# Read in data from xlsx file
data_df <- read_excel("C:\\Users\\Chiara\\OneDrive - Università di Napoli Federico II\\Desktop\\VIS\\Final project\\data.xlsx")
data_df$solarradiation <- ifelse(is.na(data_df$solarradiation), 0, data_df$solarradiation)

# Extract hour and month from datetime column
data_df$hour <- hour(data_df$datetime)
data_df$month <- month(data_df$datetime)

# Creating a heat map
ggplot(data_df, aes(x=hour, y=month, fill = solarradiation)) +
  geom_tile() +
  scale_fill_gradient(low="#FFFD78", high="red") +
  scale_y_continuous(breaks = seq(1, 12, 1), expand = c(0,0)) +
  scale_x_continuous(breaks = seq(0, 24, 1), expand = c(0,0)) +
  labs(title = "London solar radiation in 2013",
       x = "Hour of the Day",
       y = "Month",
       fill = "Solar Radiation " ~ (W/m^2)) +
  theme_minimal() +
  theme(text = element_text(size = 11),
        legend.key.size = unit(1, 'cm')) 

# Save the plot as a PDF 
ggsave("heatmap_solarradiation_2013.pdf", width = unit(7, "cm"), height = unit(5, "cm"))