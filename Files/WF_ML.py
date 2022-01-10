#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created on Tue Sep 25 21:54:23 2018

@author: iggywright
"""
#necessary libraries
import pandas as pd

import matplotlib.pyplot as plt
from matplotlib import style
style.use('fivethirtyeight')
import numpy as np
from sklearn.cluster import KMeans

def ConstructActivityDataFrame(activity):
    
    consumption_list = []
    quality_of_life_list = []
    carbon_factor_list = []
    min_carbon_factor_list = []
    
    no_MoC = 0
    one_MoC = 0
    multiple_MoC=0
    
    for index, row in individuals_df.iterrows():
        
        #if we find our desired activity 
        if (row["Activity"] == activity):
            carbon_factor=0

            #######################################################################################
            # HOW TO HANDLE DATA AND MISSING VALUES
            # Note: inefficient way to construct dataframes and could be done in less steps but
            #       this allows us to easily modify what is happening
            #######################################################################################
            
            #create list of means of consumptions that have value of 1
            means_of_consumption = []
            for x in individuals_df.columns[6:]:
                if row[x] == 1:
                    means_of_consumption.append(x)
            
            #modify values in place to line up with the carbon_footprint dataframe
            for index, val in enumerate(means_of_consumption):
                if val in ["solar_powered__water_heater", "gas_water_heater", "natural_gas"]:
                    means_of_consumption[index] = val.replace("_", " ")
                elif (val == "electric_water_heater___peak_hou"):
                    means_of_consumption[index] = "electric water heater - peak hours"
                elif val == "electric_water_heater___off_peak":
                    means_of_consumption[index] = "electric water heater - off peak hours"
                elif val == "electric___peak_hours":
                    means_of_consumption[index] = "electric - peak hours"
                elif val == "electric___off_peak_hours":
                    means_of_consumption[index] = "electric - off peak hours"
                elif val == "jetfuel":
                    means_of_consumption[index] = "Jet Fuel"
            
            #check if means of consumption has a valid value to link to in carbon_footprint dataframe
            #remove from list if not
            temp = []
            for index, val in enumerate(means_of_consumption):
                carbon_val = carbon_footprint_df.loc[carbon_footprint_df["Activity"]==activity, means_of_consumption[index]].iloc[0]    
                if (carbon_val > 0):
                    temp.append(val)
            means_of_consumption = temp
            
            #how many valid means of consumption are there
            number_of_means = len(means_of_consumption)
            
            #get minimum possible val
            min_carbon_factor = 1
            for val in carbon_footprint_df.columns[2:14]:
                carbon_val = carbon_footprint_df.loc[carbon_footprint_df["Activity"]==activity, val].iloc[0]
                if carbon_val>0:
                    if carbon_val < min_carbon_factor:
                            min_carbon_factor = carbon_val
            
            #if there is at least one valid:
            if number_of_means>0:
                if number_of_means==1:
                    one_MoC+=1
                    carbon_factor = carbon_footprint_df.loc[carbon_footprint_df["Activity"]==activity, means_of_consumption[0]].iloc[0]
                else:
                    multiple_MoC+=1
                    #get average of all means of consumption values
                    for index, val in enumerate(means_of_consumption):
                        carbon_val = carbon_footprint_df.loc[carbon_footprint_df["Activity"]==activity, means_of_consumption[index]].iloc[0]
                        carbon_factor += carbon_val
                    carbon_factor/=number_of_means
                    
            else:
                #if no validly linked values were found, we will take the average of the possible values
                count=0
                no_MoC+=1

                for val in carbon_footprint_df.columns[2:14]:
                    carbon_val = carbon_footprint_df.loc[carbon_footprint_df["Activity"]==activity, val].iloc[0]
                    
                    if carbon_val>0:
                        count+=1
                        carbon_factor+=carbon_val
                            
                carbon_factor=carbon_factor/count if count > 0 else carbon_factor
                
            #create list of consumption and QoL for all individuals
            carbon_factor_list.append(carbon_factor)
            consumption_list.append(row["Consumption"] * carbon_factor)
            quality_of_life_list.append(row["Quality_of_Life_Importance__1_10"])
            min_carbon_factor_list.append(row["Consumption"] * min_carbon_factor / row["Quality_of_Life_Importance__1_10"])
     
    #create carbon consumed per happiness index    
    index_list = []    
    for index, val in enumerate(consumption_list):
        mult = (val / quality_of_life_list[index])
        index_list.append(mult)
        
    activity_dict = {'Indnum':ind_num_list,
                'Carbon': consumption_list,
                #'Carbon Factor': carbon_factor_list,
                'Quality of Life': quality_of_life_list,
                'CCpQ Index': index_list,
                'Min Carbon': min_carbon_factor_list
                }
    df = pd.DataFrame.from_dict(activity_dict)
    df.name = activity
    
    print(activity + " df created")
    print(one_MoC, "linked with one valid means of consumption. (BEST)")
    print(multiple_MoC, "had multiple valid means of consumption and an average was taken. (AVG)")
    print(no_MoC, "did not have a valid means of consumption so an estimation was taken. (WORST)")
    print(df.head())
    #print(df.describe())
    
    return df

def all_activity_df():
    #get all activites dfs
    all_activities_df_list = []
    for activity in activities_list:
        df = ConstructActivityDataFrame(activity)
        #df.plot.scatter(x="Indnum", y="CCpQ Index")
        all_activities_df_list.append(df)
    return all_activities_df_list

"""
MAIN PROGRAM
"""
file_name = "Data+campus_challenge_FINAL.xlsx"
xl_file = pd.ExcelFile(file_name)

#pandas dataframe of each provided excel sheet
individuals_df = pd.read_excel(xl_file, "Individuals")
#modify carbon footprint==> skip first row, remove first and last two columns
carbon_footprint_df = pd.read_excel(xl_file, "Carbon Footprint", skiprows=[0])
carbon_footprint_df = carbon_footprint_df.drop(columns=['Unnamed: 0', 'Unnamed: 14', 'Notes'])
#carbon_footprint df has "Activity" that need to be relabeled
carbon_footprint_df.at[3, "Activity"] = "Use of air conditioner" #removes space at end
carbon_footprint_df.at[10, "Activity"] = "use of clothes dryer" #removes space at end
carbon_footprint_df.at[14, "Activity"] = "Small kitchen appliance in the home" #fixes typo if c_f df
carbon_footprint_df.at[17, "Activity"] = "air travel - small  plane (<50 seats)" #remove space at the end
#print(individuals_df.head())

#manipulate individuals data into new df
num_of_ind = len(individuals_df["Indnum"].unique())             #1002 individuals
ind_num_list = list(individuals_df["Indnum"].unique())                #list of all inds
num_of_activities = len(individuals_df["Activity"].unique())    #27 activities
activities_list = list(individuals_df["Activity"].unique())         #list of all activiites


all_df = all_activity_df()

big_kahuna_df = pd.DataFrame()
    
for df in all_df:
    big_kahuna_df[df.name] = df['CCpQ Index']

big_kahuna_df['Total'] = big_kahuna_df.sum(axis=1)

over_50_list = []
for index, row in big_kahuna_df.iterrows():
    if row['Total'] > big_kahuna_df["Total"].mean():
        over_50_list.append(1)
    else:
        over_50_list.append(0)

big_kahuna_df['>50% Consumer'] = over_50_list

big_kahuna_df.convert_objects(convert_numeric=True)
big_kahuna_df.fillna(0, inplace=True)

print(big_kahuna_df.head())

X = np.array(big_kahuna_df.drop(['>50% Consumer'], 1).astype(float))
y = np.array(big_kahuna_df['>50% Consumer'])

clf = KMeans(n_clusters=2)
clf.fit(X)

correct = 0
for i in range(len(X)):
    predict_me = np.array(X[i].astype(float))
    predict_me = predict_me.reshape(-1, len(predict_me))
    prediction = clf.predict(predict_me)
    if prediction[0] == y[i]:
        correct += 1

print("CORRECT PERCENT OF INDIVIDUALS CLASSIFIED: ", correct/len(X) * 100, "%")