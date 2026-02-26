library(ggplot2)
library(readxl)
library(dplyr)
library(lubridate)

# Read in data from xlsx file
energy_data <- read_excel("C:\\Users\\Chiara\\OneDrive - Università di Napoli Federico II\\Desktop\\VIS\\Final project\\data.xlsx") %>%
               mutate(difference = production - load,
                      Month = month(datetime, label = TRUE))
  
# Group the data by month and calculate the mean difference for each month
monthly_data <- energy_data %>%
                group_by(Month) %>%
                summarize(Mean_Difference = mean(difference))

ggplot(monthly_data, aes(x = Month, y = Mean_Difference, fill = Mean_Difference > 0)) +
       geom_bar(stat = "identity", width = 0.4, position = position_dodge(width = 0.2),) +
       labs(x = "Months", y = "Difference (kW)", 
            title = "Average difference between energy production and consumption in 2013", 
            fill = "") +
       scale_fill_manual(values = c("#FA1D40", "#85D917"), labels = c("Average energy required\nfrom outside", "Energy overflow")) +
       theme_minimal() +
       theme(text = element_text(size = 11),
             legend.key.size = unit(1, 'cm')) +
       coord_flip() 

# Save the plot as a PDF 
ggsave("difference_prod_cons_2013.pdf", width = unit(7, "cm"), height = unit(7, "cm"))

