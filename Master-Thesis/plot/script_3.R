library(ggplot2)
library(readxl)
library(dplyr)

# Read in data from xlsx file
data_df <- read_excel("C:\\Users\\Chiara\\OneDrive - Università di Napoli Federico II\\Desktop\\VIS\\Final project\\data.xlsx")

# Substitute every NA values with zeros
data_df$solarenergy <- ifelse(is.na(data_df$solarenergy), 0, data_df$solarenergy)
data_df$solarradiation <- ifelse(is.na(data_df$solarradiation), 0, data_df$solarradiation)
data_df$temp <- ifelse(is.na(data_df$temp), 0, data_df$temp)


# Calculate the correlation between variables 
correlation_index_load_se <- cor(data_df$load, data_df$solarenergy, method="pearson")
correlation_index_prod_se <- cor(data_df$production, data_df$solarenergy, method="pearson")
correlation_index_se <- c(correlation_index_load_se, correlation_index_prod_se)

correlation_index_load_sr <- cor(data_df$load, data_df$solarradiation, method="pearson")
correlation_index_prod_sr <- cor(data_df$production, data_df$solarradiation, method="pearson")
correlation_index_sr <- c(correlation_index_load_sr, correlation_index_prod_sr)

correlation_index_load_t <- cor(data_df$load, data_df$temp, method="pearson")
correlation_index_prod_t <- cor(data_df$production, data_df$temp, method="pearson")
correlation_index_t <- c(correlation_index_load_t, correlation_index_prod_t)

v <- c("solar energy", "solar radiation", "temperature")
a <- c("load", "production")

# Plotting the data
plot_data <- data.frame(variable = rep(v, each = 2),
                        category = rep(a, length(v)),
                        correlation = c(correlation_index_se, correlation_index_sr, correlation_index_t))

# Group the data by category
plot_data <- plot_data %>% group_by(category, variable)

# Create a grouped bar plot
ggplot(plot_data, aes(x = variable, y = correlation, fill = category)) +
  geom_bar(stat = "identity", position = position_dodge(width = 0.6), width = 0.5) +
  labs(title = "Correlation between variables", y = "Correlation index", x = "Variables", fill="Category") +
  scale_fill_manual(values = c("#FA1D40", "#85D917"), labels = c("Load", "Production")) +
  scale_y_continuous(breaks = seq(-1, 1, by = 0.1)) +
  theme_minimal() +
  theme(text = element_text(size = 12),
        legend.key.size = unit(0.7, 'cm'))

# Save the plot as a PDF 
ggsave("correlations_2013.pdf", width = unit(7, "cm"), height = unit(5, "cm"))




