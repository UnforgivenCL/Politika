require 'mechanize'
require 'json'
require 'mongo'


class Diputado
	attr_accessor :nombre, :region, :distrito, :partido, :correo

	def initialize(params)
	  params.each do |key, value|
	    instance_variable_set("@#{key}", value)
	  end
	end
end

class DataAccess
	include Mongo

	attr_accessor :client

	def initialize
		@client = Mongo::Client.new([ '127.0.0.1:27017' ], :database => 'politika')
	end

end


class Bot
	@@BaseURI = 'https://www.camara.cl/camara/diputados_print.aspx'

	attr_accessor :mechanizeInstance, :diputadosList

	def initialize
		@mechanizeInstance = Mechanize.new
		@diputadosList = []
	end

	def get_page_content
		@pageContent = @mechanizeInstance.get(@@BaseURI)
	end

	def perform_search
		diputados = @pageContent.search('table tbody tr')
		diputados.each do |diputado|
			nombre = diputado.search('td')[0].content
			region = diputado.search('td')[1].content
			distrito = diputado.search('td')[2].content
			partido = diputado.search('td')[3].content
			@diputadosList.push(Diputado.new :nombre => nombre.to_s.gsub(/\t/,"").gsub(/\r/,"").gsub(/\n/,"").strip, :region => region.to_s.gsub(/\t/,"").gsub(/\r/,"").gsub(/\n/,"").strip, :distrito => distrito.to_s.strip, :partido => partido.to_s.strip)
		end
	end

	def self.baseUri
		@@baseUri
	end

end

x = Bot.new
db = DataAccess.new

x.get_page_content
x.perform_search
x.diputadosList.each do |diputado|

	tempHash = {}

	diputado.instance_variables.each {|var| tempHash[var.to_s.delete("@")] = diputado.instance_variable_get(var) }

	result = db.client['diputados'].insert_one(tempHash)
	puts tempHash
end
